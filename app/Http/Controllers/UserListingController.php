<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class UserListingController extends Controller
{
    public function listings()
    {
        $listings = Listing::all();
        return view('user.listings.all-listings')->with('listings', $listings);
    }

    public function listing(Listing $listing)
    {
        return view('user.listings.show-listing', [
            'listing' => $listing
        ]);
    }
}
