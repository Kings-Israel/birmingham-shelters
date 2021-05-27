<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class AdminShowListingController extends Controller
{

    public function __invoke(Listing $listing)
    {
        return view('admin.listings.show', [
            'listing' => $listing->load('clientgroup', 'listingimage'),
        ]);
    }
}
