<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMetadata;
use App\Models\Listing;
use App\Models\Booking;

class UserBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function submit_booking(Request $request)
    {
        if(Booking::create($request->all())) {
            return redirect()->route('listing.all')->with('success', 'You have been added to the waiting list');
        }

        return redirect()->back()->withError('There was an error adding you to the waiting list. Please try again');
    }
}
