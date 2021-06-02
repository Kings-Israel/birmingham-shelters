<?php

namespace App\Http\Controllers;

use App\Models\ClientGroup;
use App\Models\Listing;
use App\Models\ListingDocuments;
use App\Models\ListingImage;
use Auth;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LandlordListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all_listings()
    {
        $listings = Listing::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('landlord.listing.all-listings')->with('listings', $listings);
    }

    public function basic_info()
    {
        $features = [
            'Air Condition',
            'Internet',
            'Garden',
            'Bedding',
            'Microwave',
            'Balcony',
            'Central Heating',
            'Parking',
            'Pre-Payment Meters',
        ];

        return view('landlord.listing.add-basic', ['features' => $features]);
    }

    public function client_info($id)
    {
        $client_groups = [
            'Mental Health',
            'Homeless',
            'Drug Dependency',
            'Alcohol Dependency',
            'Learning Disability',
        ];

        return view('landlord.listing.add-clientgroup', [
            'id' => $id,
            'client_groups' => $client_groups,
        ]);
    }

    public function listing_documents($id)
    {
        $listing_documents = [
            'Gas Certificate',
            'Electrical Certificate Report',
            'Fire Alarm/Smoke Detectors',
            'Emergency Lighting',
            'Fire Risk Assessment',
            'PAT',
            'Insurance',
            'Proof of Ownership/Lease'
        ];

        $proofs = [
            'fire_blanket' => 'Proof of Fire Blanket',
            'co_monitors' => 'Proof of CO Monitors',
            'flame_retardant_spray' => 'Proof of Flame Retardant Spray'
        ];

        return view('landlord.listing.add-listingdocuments')->with([
            'id' => $id,
            'listing_documents' => $listing_documents,
            'proofs' => $proofs
        ]);
    }

    public function listing_images($id)
    {
        return view('landlord.listing.add-listingimages')->with('id', $id);
    }

    public function view_listing(Listing $listing)
    {
        return view('landlord.listing.show-listing', [
            'listing' => $listing->load('clientgroup', 'listingimage'),
        ]);
    }

    public function submit_basic_info(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'address' => 'required',
            'postcode' => 'required',
            'description' => 'required',
            'living_rooms' => 'required|numeric',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'toilets' => 'required|numeric',
            'kitchen' => 'required|numeric',
            'contact_name' => "required|string",
            'contact_email' => 'required|email',
            'contact_phoneNumber' => new PhoneNumber,
        ];

        $message = [
            'numeric' => 'The input in this field must be a number'
        ];

        Validator::make($request->all(), $rules, $message)->validate();

        $listing = new Listing;
        $listing->name = $request->name;
        $listing->address = $request->address;
        $listing->postcode = $request->postcode;
        $listing->description = $request->description;
        $listing->living_rooms = $request->living_rooms;
        $listing->bedrooms = $request->bedrooms;
        $listing->bathrooms = $request->bathrooms;
        $listing->toilets = $request->toilets;
        $listing->kitchen = $request->kitchen;
        if ($request->has('other_rooms')) {
            $listing->other_rooms = $request->other_rooms;
        }

        if ($request->has('feature')) {
            $request->merge(['feature' => implode(',', (array)$request->get('feature'))]);
            $listing->features = $request->feature;
        }

        $listing->user_id = $request->user()->id;

        $listing->contact_name = $request->contact_name;
        $listing->contact_email = $request->contact_email;
        if ($request->has('contact_phoneNumber')) {
            $listing->contact_number = $request->contact_phoneNumber;
        }

        if ($listing->save()) {
            return redirect()->route('listing.add.client_info', $listing->id);
        }

        return redirect('listing/add-basicinfo')->withError('An error occured. Please try again.');
    }

    private function _checkOtherClientGroup(Request $request, string $value)
    {
        if ($request->has('client_group')) {
            return in_array($value, $request->input('client_group'));
        }

        return false;
    }

    public function submit_clientgroup_info(Request $request)
    {
        $rules = [
            'listing_id' => 'required',
            'client_group' => 'required|min:1',
            'other_support_types' => ''.($this->_checkOtherClientGroup($request, 'Other') ? 'required' : '').'',
            'support_description' => 'required|string',
            'support_hours' => 'required|numeric'
        ];

        $message = [
            'client_group.required' => 'Please pick at least one option.',
            'string' => 'The input value must be text.',
            'numeric' => 'The input value must be a number.'
        ];

        Validator::make($request->all(), $rules, $message)->validate();

        $client_group = new ClientGroup;
        $client_group->listing_id = $request->listing_id;
        if ($request->has('client_group')) {
            $request->merge(['client_group' => implode(',', (array)$request->get('client_group'))]);
            $client_group->client_group = $request->client_group;
        }

        if ($request->has('other_support_types')) {
            $client_group->other_types = $request->other_support_types;
        }

        $client_group->support_description = $request->support_description;
        $client_group->support_hours = $request->support_hours;

        if ($client_group->save()) {
            return redirect()->route('listing.add.listing_documents', $request->listing_id);
        }

        return redirect('listing/add-clientgroupinfo', $request->listing_id)->withError('An error occured. Please try again.');
    }

    private function _changeFileName(Request $request, string $filename)
    {
        $file = \substr($filename, 0, -4);
        $fileExtension = \substr($filename, -4);
        $newFileName = $file.'-'.$request->user()->first_name.'-'.$request->user()->last_name.time().$fileExtension;
        return $newFileName;
    }

    public function submit_listing_documents(Request $request)
    {

        if(!$request->has('listing_document')) {
            return redirect()->back()->withError('Please upload the requested files');
        }

        $counter = 0;
        // Save the file to DB and storage
        foreach($request->listing_document as $document => $file)
        {
            $filenameToStore = $this->_changeFileName($request, $file->getClientOriginalName());
            if ($file->storeAs('public/listing/documents', $filenameToStore)) {
                $document_to_save = new ListingDocuments;
                $document_to_save->listing_id = $request->listing_id;
                $document_to_save->document_type = $document;
                $document_to_save->filename = $filenameToStore;
                $document_to_save->expiry_date = $request->expiry_date[$counter];
                $document_to_save->save();
                $counter++;
            } else {
                return redirect()->back()->withError('An error occurred while uploading the files.');
            }
        }

        if ($request->has('proof')) {
            $listing = Listing::find($request->listing_id);

            if($request->has('proof.fire_blanket')) {
                $listing->fire_blanket = 1;
            }
            if($request->has('proof.co_monitors')) {
                $listing->co_monitors = 1;
            }
            if($request->has('proof.flame_retardant_spray')) {
                $listing->flame_retardant_spray = 1;
            }

            $listing->save();
        }

        return redirect()->route('listing.add.listing_images', $request->listing_id);
    }

    public function submit_listing_images(Request $request)
    {
        $listingImage = new ListingImage;

        if ($request->file()) {
            $filenameWithExt = $request->file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $fileExtension = $request->file->getClientOriginalExtension();
            $filenameToStore = $filename.'-'.time().'-'.$fileExtension;
            $filepath = $request->file('file')->storeAs('public/listing/images', $filenameToStore);

            $listingImage->listing_id = $request->listing_id;
            $listingImage->image_name = $filenameToStore;
            $listingImage->save();

            return redirect()->route('landlord.index')->with('success', 'Property was added successfully');
        }

        return redirect()->route('listing.add.submit_images')->withError('An error occurred. Please try again.');
    }

    public function delete_listing($id)
    {
        $listingImages = ListingImage::where('listing_id', '=', $id)->get();
        foreach ($listingImages as $image) {
            unlink(public_path('storage/listing/images/'.$image['image_name']));
        }

        $listingDocuments = ListingDocuments::where('listing_id', '=', $id)->get();
        foreach ($listingDocuments as $document) {
            unlink(public_path('storage/listing/documents/'.$document['filename']));
        }
        if (ListingImage::where('listing_id', '=', $id)->delete()) {
            if (ListingDocuments::where('listing_id', '=', $id)->delete()) {
                if (ClientGroup::where('listing_id', '=', $id)->delete()) {
                    if (Listing::destroy($id)) {
                        return redirect()->route('listing.view.all')->with('success', 'Listing has been deleted successfully');
                    }
                }
            }
        }

        return redirect()->route('listing.view.all')->withError('An error occured. Please try again');
    }
}
