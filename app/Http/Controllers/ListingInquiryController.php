<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\PhoneNumber;
use App\Models\Listing;
use App\Models\UserMetadata;
use App\Models\ListingInquiry;
use Illuminate\Support\Facades\Validator;

class ListingInquiryController extends Controller
{
    public function submit_inquiry(Request $request)
    {
        $rules = [
            'user_name' => 'required|string',
            'user_email' => 'required|email',
            'user_phone_number' => new PhoneNumber,
            'message' => 'required'
        ];
        $messages = [
            'user_name.required' => 'Please enter your full name',
            'user_email.required' => 'Please enter your email address',
            'user_email.email' => 'Please enter a valid email address',
            'message' => 'Please enter the message you would like to send'
        ];

        Validator::make($request->all(), $rules, $messages);

        // Save the inquiry
        $inquiry = new ListingInquiry::create($request->all());
        if ($inquiry->save()) {
            return redirect()->route()->with('success', "Your inquiry has been sent.");
        }

        return redirect()->back()->withError('There was an error while sending the inquiry. Please try again');

    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function submit_booking(Request $request)
    {
         // Check if user has metadata
         if (UserMetadata::where('user_id', $request->user_id)->exists()) {
            return redirect()->route('user.listing.all')->with('success', 'Your inquiry has been sent');
        } else {
            return redirect()->route('referral-form.show')->with('success', 'Your query has been sent. Please enter the following information to recieve better information for your requirements.');
        }
    }
}
