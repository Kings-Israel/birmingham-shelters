<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Booking;
use App\Models\RefereeData;

class AdminShowListingController extends Controller
{

    public function showListing(Listing $listing)
    {
        return view('admin.listings.show', [
            'listing' => $listing->load('user', 'documents'),
            'breadcrumb' => [
                'Listings' => route('admin.listings.index'),
                $listing->name => route('admin.listings.show', $listing->id),
            ],
        ]);
    }
}
