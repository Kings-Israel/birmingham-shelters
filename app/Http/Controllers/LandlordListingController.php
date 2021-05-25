<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Listing;
use App\Models\ClientGroup;
use App\Models\ListingDocuments;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

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
        return view('landlord.listing.add-basic');
    }

    public function client_info($id)
    {
        return view('landlord.listing.add-clientgroup')->with('id', $id);
    }

    public function listing_documents($id)
    {
        return view('landlord.listing.add-listingdocuments')->with('id', $id);
    }

    public function listing_images($id)
    {
        return view('landlord.listing.add-listingimages')->with('id', $id);
    }

    public function view_listing($id)
    {
        // Get Listing
        $listing = Listing::find($id);

        // Get Listing Client Groups
        $clientGroup = $listing->clientgroup;
        $clientGroup->client_group = explode(',', $clientGroup->client_group);
        $client_group = $clientGroup->client_group;
        // Get Other field's key if it exists
        if($key = array_search("Other", $clientGroup->client_group) !== false)
        {
            // Delete 'Other' from the client_group array
            unset($client_group[$key + 1]);
            $clientGroup->client_group = $client_group;

            // Change the other_types field to array
            $other_types = explode(',', $clientGroup->other_types);

            // Add the 'other_types' array to client_group array
            $clientGroup->client_group = array_merge($clientGroup->client_group, $other_types);
        }

        // Get listing Documents
        $listingDocuments = $listing->listingdocuments;

        // Get Listing Images
        $listingImages = $listing->listingimage;

        // Return listing
        return view('landlord.listing.show-listing')
            ->with([
                'listing' => $listing, 
                'client_group' => $clientGroup,
                'listing_documents' => $listingDocuments,
                'listing_images' => $listingImages
            ]);
    }

    public function submit_basic_info(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'address' => 'required',
            'postcode' => 'required',
            'local_authority_area' => 'required',
            'description' => 'required',
            'living_rooms' => 'required|numeric',
            'bedsitting_rooms' => 'required|numeric',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'toilets' => 'required|numeric',
            'kitchen' => 'required|numeric',
            'contact_name' => "required|string",
            'contact_email' => 'required|email'
        ];

        $message = [
            'numeric' => 'The input in this field must be a number'
        ];

        Validator::make($request->all(), $rules, $message)->validate();

        $listing = new Listing;
        $listing->name = $request->name;
        $listing->address = $request->address;
        $listing->postcode = $request->postcode;
        $listing->local_authority_area = $request->local_authority_area;
        $listing->description = $request->description;
        $listing->living_rooms = $request->living_rooms;
        $listing->bedsitting_rooms = $request->bedsitting_rooms;
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
        if($request->has('contact_phoneNumber')) {
            $listing->contact_number = $request->contact_phoneNumber;
        }

        if($listing->save())
        {
            return redirect()->route('listing.add.client_info', $listing->id);
        }

        return redirect('listing/add-basicinfo')->withError('An error occured. Please try again.');


    }

    private function _checkOtherClientGroup(Request $request, string $value)
    {
        if ($request->has('client_group')) {
            return in_array($value, $request->input("client_group"));
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
            'string' => "The input value must be text.",
            'numeric' => "The input value must be a number."
        ];

        Validator::make($request->all(), $rules, $message)->validate();

        $client_group = new ClientGroup;
        $client_group->listing_id = $request->listing_id;
        if ($request->has('client_group')) {
            $request->merge(['client_group' => implode(',', (array)$request->get('client_group'))]);
            $client_group->client_group = $request->client_group;
        }

        if($request->has('other_support_types')) {
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
        $newFileName = $file.'-'.$request->user()->first_name.'-'.$request->user()->last_name.$fileExtension;
        return $newFileName;
    }

    public function submit_listing_documents(Request $request)
    {
        $rules = [
            'listing_id' => 'required',
            'gas_certificate' => 'required|mimes:pdf|max:4096',
            'gas_certificate_expiry_date' => 'required|date',
            'electrical_certificate' => 'required|mimes:pdf|max:4096',
            'electrical_certificate_expiry_date' => 'required|date',
            'detectors_certificate' => 'required|mimes:pdf|max:4096',
            'detectors_certificate_expiry_date' => 'required|date',
            'emergency_lighting_certificate' => 'required|mimes:pdf|max:4096',
            'emergency_lighting_certificate_expiry_date' => 'required|date',
            'fire_risk_certificate' => 'required|mimes:pdf|max:4096',
            'fire_risk_certificate_expiry_date' => 'required|date',
            'pat_certificate' => 'required|mimes:pdf|max:4096',
            'pat_certificate_expiry_date' => 'required|date',
            'insurance_certificate' => 'required|mimes:pdf|max:4096',
            'insurance_certificate_expiry_date' => 'required|date',
            'ownership_certificate' => 'required|mimes:pdf|max:4096',
            'ownership_certificate_expiry_date' => 'required|date'
        ];

        $message = [
            'required' => 'This field is required',
            'mimes:pdf' => 'This file should be in pdf format',
            'date' => 'The input in this field should be a date',
        ];

        Validator::make($request->all(), $rules, $message)->validate();

        $listingDocument = new ListingDocuments;
        $listingDocument->listing_id = $request->listing_id;

        // Format and store file to storage
        $gasCertificate = $this->_changeFileName($request, $request->file('gas_certificate')->getClientOriginalName());
        $listingDocument->gas_certificate = $gasCertificate;
        $request->file('gas_certificate')->storeAs('public/listing/documents', $gasCertificate);
        $listingDocument->gas_certificate_expiry_date = $request->gas_certificate_expiry_date;

        $electricalCertificate = $this->_changeFileName($request, $request->file('electrical_certificate')->getClientOriginalName());
        $listingDocument->electrical_certificate = $electricalCertificate;
        $request->file('electrical_certificate')->storeAs('public/listing/documents', $electricalCertificate);
        $listingDocument->electrical_certificate_expiry_date = $request->electrical_certificate_expiry_date;

        $detectorsCertificate = $this->_changeFileName($request, $request->file('detectors_certificate')->getClientOriginalName());
        $listingDocument->detectors_certificate = $detectorsCertificate;
        $request->file('detectors_certificate')->storeAs('public/listing/documents', $detectorsCertificate);
        $listingDocument->detectors_certificate_expiry_date = $request->detectors_certificate_expiry_date;

        $emergency_lightingCertificate = $this->_changeFileName($request, $request->file('emergency_lighting_certificate')->getClientOriginalName());
        $listingDocument->emergency_lighting_certificate = $emergency_lightingCertificate;
        $request->file('emergency_lighting_certificate')->storeAs('public/listing/documents', $emergency_lightingCertificate);
        $listingDocument->emergency_lighting_certificate_expiry_date = $request->emergency_lighting_certificate_expiry_date;

        $fire_riskCertificate = $this->_changeFileName($request, $request->file('fire_risk_certificate')->getClientOriginalName());
        $listingDocument->fire_risk_certificate = $fire_riskCertificate;
        $request->file('fire_risk_certificate')->storeAs('public/listing/documents', $fire_riskCertificate);
        $listingDocument->fire_risk_certificate_expiry_date = $request->fire_risk_certificate_expiry_date;

        $patCertificate = $this->_changeFileName($request, $request->file('pat_certificate')->getClientOriginalName());
        $listingDocument->pat_certificate = $patCertificate;
        $request->file('pat_certificate')->storeAs('public/listing/documents', $patCertificate);
        $listingDocument->pat_certificate_expiry_date = $request->pat_certificate_expiry_date;

        $insuranceCertificate = $this->_changeFileName($request, $request->file('insurance_certificate')->getClientOriginalName());
        $listingDocument->insurance_certificate = $insuranceCertificate;
        $request->file('insurance_certificate')->storeAs('public/listing/documents', $insuranceCertificate);
        $listingDocument->insurance_certificate_expiry_date = $request->insurance_certificate_expiry_date;

        $ownershipCertificate = $this->_changeFileName($request, $request->file('ownership_certificate')->getClientOriginalName());
        $listingDocument->ownership_certificate = $ownershipCertificate;
        $request->file('ownership_certificate')->storeAs('public/listing/documents', $ownershipCertificate);
        $listingDocument->ownership_certificate_expiry_date = $request->ownership_certificate_expiry_date;

        if ($request->has('proof')) {
            $request->merge(['proof' => implode(',', (array)$request->get('proof'))]);
            $listingDocument->proofs = $request->proof;
        }

        if ($listingDocument->save()) {
            return redirect()->route('listing.add.listing_images', $request->listing_id);
        }

        return redirect('listing/add-listingdocuments', $request->listing_id)->withError('An error occured. Please try again.');
    }

    public function submit_listing_images(Request $request)
    {
        // $rules = [
        //     'listing_id' => 'required',
        //     'file' => 'required|mimes:png,jpg,jpeg'
        // ];

        // $message = [
        //     'required' => 'This field is required',
        //     'mimes:png,jpg,jpeg' => 'Incorrect file format'
        // ];

        // Validator::make($request->all(), $rules, $message)->validate();

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

        return redirect()->route('listing.add.submit_images')->withErrors('An error occurred. Please try again.');
        
    }

    public function delete_listing($id)
    {
        $listingImages = ListingImage::where('listing_id', '=', $id)->get();
        foreach ($listingImages as $image) {
            unlink(public_path('storage/listing/images/'.$image->image_name));
        }
            
        $listingDocuments = ListingDocuments::where('listing_id', '=', $id)->get();
        foreach ($listingDocuments as $document) {
            unlink(public_path('storage/listing/documents/'.$document->gas_certificate));
            unlink(public_path('storage/listing/documents/'.$document->electrical_certificate));
            unlink(public_path('storage/listing/documents/'.$document->detectors_certificate));
            unlink(public_path('storage/listing/documents/'.$document->emergency_lighting_certificate));
            unlink(public_path('storage/listing/documents/'.$document->fire_risk_certificate));
            unlink(public_path('storage/listing/documents/'.$document->pat_certificate));
            unlink(public_path('storage/listing/documents/'.$document->insurance_certificate));
            unlink(public_path('storage/listing/documents/'.$document->ownership_certificate));
        }
        if (ListingImage::where('listing_id', '=', $id)->delete()) {
            if (ListingDocuments::where('listing_id', '=', $id)->delete()) {
                if(ClientGroup::where('listing_id', '=', $id)->delete()) {
                    if(Listing::destroy($id)) {
                        return redirect()->route('listing.index')->with('success', 'Listing has been deleted successfully');
                    }
                }
            }
        }


        return redirect()->route('listing.index')->withErrors('An error occured. Please try again');
    }
}
