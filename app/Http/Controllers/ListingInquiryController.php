<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\PhoneNumber;
use App\Models\Listing;
use App\Models\UserMetadata;
use App\Models\ListingInquiry;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendInquiryReplyMail;

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

    public function deleteInquiry($id) 
    {
        if (ListingInquiry::destroy($id)) {
            return redirect()->back()->with('success', 'Inquiry deleted');
        }

        return redirect()->back()->withError('Failed to delete inquiry.');
    }

    public function replyToInquiry(Request $request)
    {
        $listingInquiry = ListingInquiry::find($request->inquiry_id);
        $listingInquiry->read_at = now();
        $listingInquiry->message_response = $request->message_response;

        if($listingInquiry->save()) {
            return redirect()->back()->with('success', 'Your response has been sent.');
        }

        return redirect()->back()->withError('Message not sent.');
    }

    public function replyThroughMail($id)
    {
        $listingInquiry = ListingInquiry::find($id);
        return view('landlord.inquiry-reply')->with('listingInquiry', $listingInquiry);
    }

    public function emailReply(Request $request)
    {
        $rules = [
            'inquiry_reply_email' => 'required|email',
            'inquiry_reply_subject' => 'required',
            'inquiry_reply_content' => 'required'
        ];
        $messages = [
            'required' => "Please enter this information",
            'inquiry_reply_email.email' => 'Please enter a valid email'
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $listingInquiry = ListingInquiry::find($request->inquiry_id);

        $data = [
            'inquiry' => $listingInquiry->listing_message,
            'reply_email' => $request->inquiry_reply_email,
            'subject' => $request->inquiry_reply_subject,
            'content' => $request->inquiry_reply_content,
        ];

        SendInquiryReplyMail::dispatchAfterResponse($data['inquiry'], $data['reply_email'], $data['subject'], $data['content']);

        $listingInquiry->read_at = now();

        if ($listingInquiry->save()) {
            return redirect()->back()->with('success', 'Email successfully sent');
        }

    }
}
