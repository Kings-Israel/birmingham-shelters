<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Listing;
use App\Models\ListingImage;
use Auth;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::where('user_id', '=', Auth::user()->id)->get();
        return view('landlord.all-listings')->with('listings', $listings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landlord.add-listing');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'service_charge' => 'required|numeric',
            'area' => 'numeric',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'address' => 'required',
            'state' => 'required|string',
            'zip_code' => 'required',
            'city' => 'required|string',
            'description' => 'required',
            'features' => 'required',
        ]);

        $listing = new Listing;
        $listing->name = $request->name;
        $listing->service_charge = $request->service_charge;
        $listing->area = $request->area;
        $listing->bedrooms = $request->bedrooms;
        $listing->bathrooms = $request->bathrooms;
        $listing->address = $request->address;
        $listing->state = $request->state;
        $listing->zip_code = $request->zip_code;
        $listing->city = $request->city;
        $listing->description = $request->description;
        $listing->features = $request->features;
        $listing->user_id = $request->user()->id;
        
        if ($listing->save()) {
            return response()->json(['message' => 'listing saved', 'id' => $listing->id]);
        }
    }

    public function store_image(Request $request)
    {
        $validator = $request->validate([
            'file' => 'image|mimes:png,jpg,jpeg',
        ]);

        $listingImage = new ListingImage;
        
        if ($request->file()) {
            $filename = $request->file->getClientOriginalName();
            $filepath = $request->file('file')->storeAs('/public/listing/images', $filename);

            $listingImage->listing_id = $request->listing_id;
            $listingImage->image_name = $filename;
            $listingImage->save();

            return redirect()->route('listing.index')->with('success', 'File has been uploaded');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listing = Listing::with('listingimage')->find($id);
        $features = explode(",", $listing->features);
        return view('landlord.show-listing')->with(['listing' => $listing, 'features' => $features]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
