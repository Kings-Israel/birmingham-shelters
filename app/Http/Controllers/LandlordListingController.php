<?php

namespace App\Http\Controllers;

use App\Enums\ListingDocumentTypesEnum;
use App\Enums\ListingProofsEnum;
use App\Enums\BookingStatusEnum;
use App\Enums\InvoiceTypeEnum;
use App\Enums\ListingStatusEnum;
use App\Models\Listing;
use App\Models\ListingInquiry;
use App\Models\RefereeData;
use App\Models\ListingDocument;
use App\Models\Booking;
use App\Rules\PhoneNumber;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LandlordListingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function allListings()
    {
        $listings = Listing::where('user_id', '=', Auth::user()->id)->orderBy('created_at', "DESC")->get();
        $listings->loadCount(['inquiry' => function($query) {
            $query->where('read_at', null);
        }]);
        $listings->loadCount(['bookings' => function($query) {
            $query->where('status', BookingStatusEnum::pending()->value);
        }]);

        return view('landlord.listing.all-listings')
                    ->with('listings', $listings);
    }

    public function viewListing(Listing $listing)
    {
        $supported_groups = $this->clientInfo($listing->id)->supported_groups;

        $listing->loadCount(['inquiry' => function($query) {
            $query->where('read_at', null);
        }]);

        $listing->loadCount(['bookings' => function($query) {
            $query->where('status', BookingStatusEnum::pending()->value);
        }]);

        return view('landlord.listing.show-listing')->with(
            [
                'listing' => $listing, 
                'supported_groups' => $supported_groups,
                'listing_document_types' => ListingDocumentTypesEnum::toArray(),
                'proofs' => ListingProofsEnum::toArray()
            ]
        );
    }

    public function viewListingBookings(Listing $listing)
    {
        $referee_data = collect([]);
        foreach ($listing->bookings as $booking) {
            $referee_data->push(RefereeData::where('id', '=', $booking->referee_data_id)->paginate(10));
        }

        return view('landlord.bookings')->with(['referee_data' => $referee_data, 'listing_id' => $listing->id]);
    }

    public function deleteBooking($user_id, $referee_data_id, $listing_id)
    {
        $deleted = Booking::where([
            ['user_id', '=', $user_id],
            ['referee_data_id', '=', $referee_data_id],
            ['listing_id', '=', $listing_id]
        ])->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'The Booking has been deleted');
        } else {
            return redirect()->back()->withError('An error occurred while deleting.');
        }
    }

    public function viewListingInquiries(Listing $listing)
    {
        return view('landlord.inquiries')
                ->with(
                    'inquiries',  
                    $listing->load(['inquiry' => function($query) {
                        $query->orderBy('id', 'DESC');
                    }]));
    }

    public function deleteInquiry($id) 
    {
        if (ListingInquiry::destroy($id)) {
            return redirect()->back()->with('success', 'Inquiry deleted');
        }

        return redirect()->back()->withError('Failed to delete inquiry.');
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
        $this->authorize('update', Listing::findOrFail($id));

        $supported_groups = [
            'Mental Health',
            'Homeless',
            'Drug Dependency',
            'Alcohol Dependency',
            'Learning Disability',
        ];

        return view('landlord.listing.add-clientgroup', [
            'id' => $id,
            'supported_groups' => $supported_groups,
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
            'available_rooms' => 'required|numeric',
            'toilets' => 'required|numeric',
            'kitchen' => 'required|numeric',
            'contact_name' => 'required|string',
            'contact_email' => 'required|email',
            'contact_number' => ['nullable', new PhoneNumber],
            'other_rooms' => 'nullable|string',
            'features' => 'sometimes|array'
        ];

        $messages = [
            'numeric' => 'The input in this field must be a number'
        ];

        $validated_data = $request->validate($rules, $messages);

        $listing = Auth::user()->listings()->create($validated_data);

        return redirect()->route('listing.add.client_info', $listing->id);
    }

    public function updateBasicInfo(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'address' => 'required',
            'postcode' => 'required',
            'description' => 'required',
            'living_rooms' => 'required|numeric',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'available_rooms' => 'required|numeric',
            'toilets' => 'required|numeric',
            'kitchen' => 'required|numeric',
            'contact_name' => 'required|string',
            'contact_email' => 'required|email',
            'contact_number' => ['nullable', new PhoneNumber],
            'other_rooms' => 'nullable|string',
            'features' => 'sometimes|array'
        ];

        $messages = [
            'numeric' => 'The input in this field must be a number'
        ];

        $validated_data = $request->validate($rules, $messages);

        $listing = Listing::where('id', $request->listing_id)->update($validated_data);

        if($listing) {
            return response()->json("success");
        }
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
        $this->authorize('update', Listing::findOrFail($request->listing_id));

        $rules = [
            'listing_id' => 'required',
            'supported_groups' => ['required', 'array', 'min:1'],
            'other_supported_groups' => ''.($this->_checkOtherClientGroup($request, 'Other') ? 'required' : '').'',
            'support_description' => 'required|string',
            'support_hours' => 'required|numeric'
        ];

        $message = [
            'supported_groups.required' => 'Please pick at least one option.',
            'string' => 'The input value must be text.',
            'numeric' => 'The input value must be a number.'
        ];

        $validated = Validator::make($request->all(), $rules, $message)->validate();

        $update_data = collect($validated)
            ->when($request->filled('other_supported_groups'), function (Collection $collection) {
                $collection['supported_groups'] = collect($collection['supported_groups'])
                            ->reject(fn ($value) => $value === 'Other')
                            ->merge(
                                collect(explode(',', $collection['other_supported_groups']))->map(fn ($value) => trim($value))
                            )->all();
                return $collection;
            })
            ->except('listing_id')
            ->all();
            $update_data = collect($update_data)->except('other_supported_groups')->toArray();

        Listing::whereId($request->listing_id)
            ->update($update_data);

        return redirect()->route('listing.add.listing_documents', $request->listing_id);
    }

    public function updateClientGroupInfo(Request $request) 
    {
        $rules = [
            'supported_groups' => ['required', 'array', 'min:1'],
            'other_supported_groups' => ''.($this->_checkOtherClientGroup($request, 'Other') ? 'required' : '').'',
            'support_description' => 'required|string',
            'support_hours' => 'required|numeric'
        ];

        $message = [
            'supported_groups.required' => 'Please pick at least one option.',
            'string' => 'The input value must be text.',
            'numeric' => 'The input value must be a number.'
        ];

        $validated = Validator::make($request->all(), $rules, $message)->validate();

        $update_data = collect($validated)
            ->when($request->filled('other_supported_groups'), function (Collection $collection) {
                $collection['supported_groups'] = collect($collection['supported_groups'])
                            ->reject(fn ($value) => $value === 'Other')
                            ->merge(
                                collect(explode(',', $collection['other_supported_groups']))->map(fn ($value) => trim($value))
                            )->all();
                return $collection;
            })
            ->except('listing_id')
            ->all();
            $update_data = collect($update_data)->except('other_supported_groups')->toArray();

        $listing = Listing::whereId($request->listing_id)->update($update_data);

        if($listing) {
            return response()->json("success");
        }
    }

    public function submitListingDocuments(Request $request)
    {
        $this->authorize('update', Listing::findOrFail($request->listing_id));

        $rules = [
            'listing_id' => ['required', 'integer'],
            'listing_documents' => ['required', 'array', 'size:'.count(ListingDocumentTypesEnum::toArray())],
            'listing_documents.*' => ['required', 'mimes:pdf'],
            'expiry_dates' => ['required', 'array'],
            'expiry_dates.*' => ['required', 'date'],
            'proof' => ['sometimes', 'array'],
        ];

        $messages = [
            'listing_documents.required' => 'Please upload all required documents.',
            'listing_documents.*.required' => 'Please upload all documents',
            'listing_documents.size' => 'Please upload all required documents.',
            'listing_documents.*.mimes' => 'Only PDFs are accepted.',
            'expiry_dates.*.required' => 'An expiry date is required',
        ];

        $validated = $request->validate($rules, $messages);
        foreach ($validated['listing_documents'] as $document_type => $file) {
            ListingDocument::create([
                'listing_id' => $validated['listing_id'],
                'document_type' => $document_type,
                'filename' => pathinfo($file->store('documents', 'listing'), PATHINFO_BASENAME),
                'expiry_date' => $validated['expiry_dates'][$document_type],
            ]);
        }

        $request->whenFilled('proof', function ($input) use ($request) {
            Listing::whereId($request->listing_id)->update(['proofs' => array_keys($input)]);
        });

        if(!$request->has('proof')) {
            Listing::whereId($request->listing_id)->update(['proofs' => []]);
        }

        
        return redirect()->route('listing.add.listing_images', $request->listing_id);

    }

    public function updateListingDocuments(Request $request)
    {   
        $document = ListingDocument::where('listing_id', $request->listing_id)->get();
        $document->each(fn (ListingDocument $document) => $document->delete());
        $rules = [
            'listing_id' => ['required', 'integer'],
            'listing_documents' => ['required', 'array', 'size:'.count(ListingDocumentTypesEnum::toArray())],
            'listing_documents.*' => ['required', 'mimes:pdf'],
            'expiry_dates' => ['required', 'array'],
            'expiry_dates.*' => ['required', 'date'],
            'proof' => ['sometimes', 'array'],
        ];

        $messages = [
            'listing_documents.required' => 'Please upload all required documents.',
            'listing_documents.*.required' => 'Please upload all documents',
            'listing_documents.size' => 'Please upload all required documents.',
            'listing_documents.*.mimes' => 'Only PDFs are accepted.',
            'expiry_dates.*.required' => 'An expiry date is required',
        ];
        
        $validated = $request->validate($rules, $messages);

        foreach ($validated['listing_documents'] as $document_type => $file) {
            ListingDocument::create([
                'listing_id' => $validated['listing_id'],
                'document_type' => $document_type,
                'filename' => pathinfo($file->store('documents', 'listing'), PATHINFO_BASENAME),
                'expiry_date' => $validated['expiry_dates'][$document_type],
            ]);
        }

        $request->whenFilled('proof', function ($input) use ($request) {
            Listing::whereId($request->listing_id)->update(['proofs' => array_keys($input)]);
        });

        if(!$request->has('proof')) {
            Listing::whereId($request->listing_id)->update(['proofs' => []]);
        }

        return redirect()->back()->with('success', 'Documents Updated');
    }

    public function submitListingImages(Request $request)
    {
        $this->authorize('update', $listing = Listing::findOrFail($request->listing_id));

        abort_unless($request->file('file'), Response::HTTP_NOT_FOUND);

        $listing->images = collect($listing->images)->push(
            $filename = pathinfo($request->file('file')->store('images', 'listing'), PATHINFO_BASENAME)
        );

        $listing->status = ListingStatusEnum::pending();

        $listing->save();

        return response()->json([
            'listingId' => $listing->id,
            'filename' => $filename,
        ]);
    }

    public function deleteAllImages($id)
    {
        // Get images and delete from disk
        $listing = Listing::where('id', $id)->get();
        $listing_images = $listing->first()->images;
        $listing_images->each(fn ($image) => Storage::disk('listing')->delete('images/'.$image));
        $listing->first()->images = [];
        $listing->first()->status = ListingStatusEnum::draft();
        $listing->first()->save();
        return redirect()->back()->with('success', 'All images are deleted');
    }

    public function deleteRemovedImage(Listing $listing)
    {
        $image = request('filename');

        Storage::disk('listing')->delete("images/$image");

        $listing->images = $listing->images->reject(fn ($value) => $value === $image);
        $listing->save();

        return response()->json(['message' => 'Deleted image successfully.']);
    }

    public function deleteListing(Listing $listing)
    {
        $this->authorize('delete', $listing);

        $listing->load(['documents', 'bookings', 'inquiry' , 'listingFeedback']);

        $listing->documents->each(fn (ListingDocument $document) => $document->delete());

        $listing->bookings()->delete();

        $listing->inquiry()->delete();

        $listing->listingFeedback()->delete();

        $listing->delete();

        return redirect()->route('listing.view.all')->with('success', 'Listing has been deleted successfully');
    }

    public function cancelListingAddition($id = null)
    {
        $user_type = Auth::user()->user_type;
        if($id == null) {
            return redirect()->route('listing.view.all');
        }

        if (ListingDocument::where('listing_id', $id)->exists()) {
            $listing_documents = ListingDocument::where('listing_id', $id)->get();
            $listing_documents->each(fn (ListingDocument $document) => $document->delete());
        }

        if(Listing::where('id', $id)->delete()) {
            return redirect()->route('listing.view.all');
        } else {
            return redirect()->back()->withError('An error occurred. Please try again');
        }

    }

    public function checkBookingStatus(Request $request)
    {
        $referee_details = json_decode($request->referee_details);
        // Check booking status
        $bookings = Booking::where('referee_data_id', '=', $referee_details->id)->get();
        foreach ($bookings as $booking) {
            // if status == awaiting payment | status == approved
            // // redirect back with message User has been approved for another listing
            if ($booking->status == BookingStatusEnum::awaiting_payment()->label || $booking->status == BookingStatusEnum::approved()->label) {
                return redirect()->back()->withError('The User has aleady been approved for another listing.');
            }
        }

        // Get the listing id, user id and referee data id to change the booking status to awaiting payment

        $listing = Listing::find($request->listing_id);

        $booking = $bookings->where('listing_id', $listing->id)->where('user_id', $referee_details->user_id);
        foreach($booking as $getBooking) {
            $getBooking->status = BookingStatusEnum::awaiting_payment()->label;
            $getBooking->save();


            $invoice = $getBooking->invoice()->create([
                'user_id' => Auth::user()->id,
                'invoice_type' => InvoiceTypeEnum::referral_fee(),
                'description' => 'Approval for booking for the user: '.$referee_details->applicant_name.', for the listing: '.$listing->name.'',
                'total' => 100,
            ]);
    
            return redirect()->route('invoice.checkout.page', $invoice->id);
        }
    }
}
