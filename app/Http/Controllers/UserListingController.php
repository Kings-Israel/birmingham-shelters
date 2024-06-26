<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendSMSNotification;

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
        $listing = Listing::find($request->listing_id);
        $listing_name = $listing->name;

        // Send new booking SMS notification to the landlord
        SendSMSNotification::dispatchAfterResponse($listing->user->phone_number, 'A new booking has been made on the listing '.$listing_name.'. Please login to view details. Regards, Sheltered Birmingham.');

        if(Booking::create($request->all())) {
            return redirect()->back()->with('success', 'You have been added to the waiting list');
        } else {
            return redirect()->back()->withError('There was an error adding you to the waiting list. Please try again');
        }
    }

    public function deleteBooking($user_id, $referee_data_id, $listing_id)
    {
        $deleted = Booking::where([
            ['user_id', '=', $user_id],
            ['referee_data_id', '=', $referee_data_id],
            ['listing_id', '=', $listing_id]
        ])->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'The Booking has been deleted');
        } else {
            return redirect()->back()->withError('An error occurred while deleting.');
        }
    }
}
