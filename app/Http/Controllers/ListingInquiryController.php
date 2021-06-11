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
    public function submitInquiry(Request $request)
    {
        $rules = [
            'user_name' => 'required|string',
            'user_email' => 'required|email',
            'user_phone_number' => new PhoneNumber,
            'listing_message' => 'required'
        ];
        $messages = [
            'user_name.required' => 'Please enter your full name.',
            'user_email.required' => 'Please enter your email address.',
            'user_email.email' => 'Please enter a valid email address.',
            'listing_message.required' => 'Please enter the message you would like to send.'
        ];

        Validator::make($request->all(), $rules, $messages)->validate();
        
        // Save the inquiry
        if (ListingInquiry::create($request->all())) {
            return redirect()->back()->with('success', "Your inquiry has been sent.");
        }

        return redirect()->back()->withError('There was an error while sending the inquiry. Please try again');

    }
}
