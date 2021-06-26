<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Pnlinh\InfobipSms\Facades\InfobipSms;

class UserListingController extends Controller
{

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
            // $response = InfobipSms::send('+254707137687', 'A new booking has been made');
            // if($response[0] == 200) {
            // } else {
            //     dd($response[1]);
            // }
        } else {
            return redirect()->back()->withError('There was an error adding you to the waiting list. Please try again');
        }
    }
}
