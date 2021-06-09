<?php

namespace App\Http\Controllers;

use App\Enums\ListingDocumentTypesEnum;
use App\Enums\ListingProofsEnum;
use App\Models\ClientGroup;
use App\Models\Listing;
use App\Models\ListingDocument;
use App\Models\ListingImage;
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
        $this->middleware('auth');
    }

    public function all_listings()
    {
        return view('landlord.listing.all-listings')
                    ->with('listings', Auth::user()->listings()->orderBy('created_at', 'DESC')->get());
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

    public function listing_documents($id)
    {
        return view('landlord.listing.add-listingdocuments')->with([
            'id' => $id,
            'listing_document_types' => ListingDocumentTypesEnum::toArray(),
            'proofs' => ListingProofsEnum::toArray(),
        ]);
    }

    public function listing_images($id)
    {
        return view('landlord.listing.add-listingimages')->with('id', $id);
    }

    public function view_listing(Listing $listing)
    {
        return view('landlord.listing.show-listing')->with('listing', $listing);
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

        if (isset($validated_data['other_rooms'])) {
            $validated_data['other_rooms'] = collect(explode(',', $validated_data['other_rooms']))
                                                ->map(fn($value) => trim($value))
                                                ->all();
        }

        $listing = Auth::user()->listings()->create($validated_data);

        return redirect()->route('listing.add.client_info', $listing->id);

    }

    public function submit_clientgroup_info(Request $request)
    {
        $this->authorize('update', Listing::findOrFail($request->listing_id));

        $rules = [
            'listing_id' => 'required',
            'supported_groups' => ['required', 'array', 'min:1'],
            'other_supported_groups' => [
                Rule::requiredIf(in_array('Other', $request->input('supported_groups'))),
                'string'
            ],
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
                            ->reject(fn($value) => $value === "Other")
                            ->merge(
                                collect(explode(',', $collection['other_supported_groups']))->map(fn ($value) => trim($value))
                                )->all();
                return $collection->except('other_supported_groups');
            })
            ->except('listing_id')
            ->all();

        Listing::whereId($request->listing_id)
            ->update($update_data);

        return redirect()->route('listing.add.listing_documents', $request->listing_id);
    }

    public function submit_listing_documents(Request $request)
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

        return redirect()->route('listing.add.listing_images', $request->listing_id);
    }

    public function submit_listing_images(Request $request)
    {
        $this->authorize('update', $listing = Listing::findOrFail($request->listing_id));

        abort_unless($request->file('file'), Response::HTTP_NOT_FOUND);

        $listing->images->push(
            $filename = pathinfo($request->file('file')->store('images', 'listing'), PATHINFO_BASENAME)
        );

        $listing->save();

        return response()->json([
            'listingId' => $listing->id,
            'filename' => $filename,
        ]);
    }

    public function delete_removed_image(Listing $listing)
    {
        $image = request('filename');

        Storage::disk("listing")->delete("images/$image");

        $listing->images = $listing->images->reject(fn($value) => $value === $image);
        $listing->save();

        return response()->json(['message' => 'Deleted image successfully.']);
    }

    public function delete_listing(Listing $listing)
    {
        $this->authorize('delete', $listing);

        $listing->load('documents');

        $listing->documents->each(fn (ListingDocument $document) => $document->delete());

        $listing->delete();

        return redirect()->route('listing.view.all')->with('success', 'Listing has been deleted successfully');
    }
}
