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

    public function listing(Listing $listing)
    {
        return view('user.listings.show-listing', [
            'listing' => $listing->load('clientgroup', 'listingimage')
        ]);
    }
}
