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
        // Check if user has metadata
        if (UserMetadata::where('user_id', $request->user_id)->exists()) {
            // User has metadata therefore redirect to all listings after saving the booking
            if(Booking::create($request->all())) {
                return redirect()->route('user.listing.all')->with('success', 'You have been added to the waiting list.');
            }
        } else {
            // User does not have metadata therefore redirecting to referral form page after saving the booking
            if (Booking::create($request->all())) {
                return redirect()->route('referral-form.show')->with('success', 'You have been added to the waiting list. Please enter the following information.');
            }
        }

        return redirect()->back()->withError('There was an error adding you to the waiting list. Please try again');
    }
}
