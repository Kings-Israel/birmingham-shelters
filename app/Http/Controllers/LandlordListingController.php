<?php

namespace App\Http\Controllers;

use App\Enums\ListingDocumentTypesEnum;
use App\Enums\ListingProofsEnum;
use App\Models\ClientGroup;
use App\Models\Listing;
use App\Models\ListingDocuments;
use App\Models\ListingImage;
use App\Models\RefereeData;
use Auth;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LandlordListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allListings()
    {
        $listings = Listing::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('landlord.listing.all-listings')->with('listings', $listings);
    }

    public function viewListing(Listing $listing)
    {
        return view('landlord.listing.show-listing', [
            'listing' => $listing->load('clientgroup', 'listingimage', 'bookings'),
        ]);
    }

    public function viewListingBookings(Listing $listing)
    {
        $referee_data = collect([]);
        foreach ($listing->bookings as $booking) {
            $referee_data->push(RefereeData::where('id', '=', $booking->referee_data_id)->paginate(10));
        }

        return view('landlord.bookings')->with(['referee_data' => $referee_data, 'listing_id' => $listing->id]);
    }

    public function viewListingInquiries()
    {

    }

    public function basicInfo()
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

    public function clientInfo($id)
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

    public function listingDocuments($id)
    {
        return view('landlord.listing.add-listingdocuments')->with([
            'id' => $id,
            'listing_document_types' => ListingDocumentTypesEnum::toArray(),
            'proofs' => ListingProofsEnum::toArray(),
        ]);
    }

    public function listingImages($id)
    {
        return view('landlord.listing.add-listingimages')->with('id', $id);
    }

    public function submitBasicInfo(Request $request)
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

    public function submitClientgroupInfo(Request $request)
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

    public function submitListingDocuments(Request $request)
    {
        $rules = [
            'listing_id' => ['required', 'integer'],
            'listing_documents' => ['required', 'array', 'size:'.count(ListingDocumentTypesEnum::toArray())],
            'listing_documents.*' => ['required', 'mimes:pdf'],
            'expiry_dates' => ['required', 'array'],
            'expiry_dates.*' => ['required', 'date'],
            'proof' => ['sometimes','array'],
        ];

        $messages = [
            'listing_documents.required' => 'Please upload all required documents.',
            'listing_documents.size' => 'Please upload all required documents.',
            'listing_documents.*.mimes' => 'Only PDFs are accepted.',
            'expiry_dates.*.required' => 'An expiry date is required',
        ];

        $validated = $request->validate($rules, $messages);

        foreach($validated['listing_documents'] as $document_type => $file) {
            ListingDocuments::create([
                'listing_id' => $validated['listing_id'],
                'document_type' =>  $document_type,
                'filename' => pathinfo($file->store('documents', 'listing'), PATHINFO_BASENAME),
                'expiry_date' => $validated['expiry_dates'][$document_type],
            ]);
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

    public function submitListingImages(Request $request)
    {
        abort_unless($request->file('file'), Response::HTTP_NOT_FOUND);

        $listing_image = ListingImage::create([
            'listing_id' => $request->listing_id,
            'image_name' => pathinfo($request->file('file')->store('images', 'listing'), PATHINFO_BASENAME),
        ]);

        return response()->json($listing_image);
    }

    public function deleteRemovedImage(ListingImage $listing_image)
    {
        if(!$listing_image->delete()){
            return response()
                ->json(['message' => 'Could not delete image'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['message' => 'Deleted image successfully.']);
    }

    public function deleteListing(Listing $listing)
    {
        $listing->load(['listingimage', 'documents', 'clientgroup', 'bookings']);

        $listing->listingimage->each(fn(ListingImage $image) => $image->delete());

        $listing->documents->each(fn(ListingDocuments $document) => $document->delete());

        $listing->clientgroup->delete();

        $listing->bookings->delete();

        $listing->delete();

        return redirect()->route('listing.view.all')->with('success', 'Listing has been deleted successfully');
    }
}
