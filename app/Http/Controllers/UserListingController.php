<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ClientGroup;
use Illuminate\Http\Request;

class UserListingController extends Controller
{
    public function listings()
    {
        $listings = Listing::paginate(10);
        return view('user.listings.all-listings', compact('listings'));
    }

    public function listing(Listing $listing)
    {
        return view('user.listings.show-listing', [
            'listing' => $listing->load('clientgroup', 'listingimage')
        ]);
    }
}
