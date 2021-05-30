<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\UserMetadata;
use App\Models\ListingInquiry;

class ListingInquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function submit_inquiry(Request $request)
    {
        // Save the inquiry
        $inquiry = new ListingInquiry;
        $inquiry->listing_id = $request->listing_id;
        $inquiry->user_id = $request->user()->id;
        $inquiry->message = $request->listing_message;
        $inquiry->save();

        // Check if user has metadata
        if (UserMetadata::where('user_id', $request->user_id)->exists()) {
            return redirect()->route('user.listing.all')->with('success', 'Your inquiry has been sent');
        } else {
            return redirect()->route('referral-form.show')->with('success', 'Your query has been sent. Please enter the following information to recieve better information for your requirements.');
        }
    }
}
