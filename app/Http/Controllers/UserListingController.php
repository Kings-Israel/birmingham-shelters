<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserListingController extends Controller
{
    public function listings()
    {
        $listings = Listing::paginate(10);
        return view('listings.all-listings', compact('listings'));
    }

    public function searchListings(Request $request)
    {
        $rules = [
            'search_location' => 'required'
        ];
        $message = [
            'required' => 'Please enter a location'
        ];

        Validator::make($request->all(), $rules, $message)->validate();

        $results = Listing::query()
            ->where('address', 'LIKE', "%{$request->search_location}%")
            ->paginate(10);

        return view('listings.search-listings-results')->with('listings', $results);
    }

    public function listing(Listing $listing)
    {
        return view('listings.show-listing', [
            'listing' => $listing->load('bookings')
        ]);
    }

    public function submitBooking(Request $request)
    {
        if(Booking::create($request->all())) {
            return redirect()->back()->with('success', 'You have been added to the waiting list');
        } else {
            return redirect()->back()->withError('There was an error adding you to the waiting list. Please try again');
        }
    }
}
