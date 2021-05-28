<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ClientGroup;
use Illuminate\Http\Request;

class UserListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listings()
    {
        $listings = Listing::all();
        return view('user.listings.all-listings')->with('listings', $listings);
    }

    public function listing($id)
    {
        $listing = Listing::with('clientgroup', 'listingimage')->find($id);

        // Convert features field to array
        $get_features = explode(',', $listing->features);
        $listing->features = $get_features;

        // Get other rooms field if exists and convert to array
        if($listing->other_rooms != '' )
        {
            $get_other_rooms = explode(',', $listing->other_rooms);
            $listing->other_rooms = $get_other_rooms;
        }

        return view('user.listings.show-listing')->with('listing', $listing);
    }
}
