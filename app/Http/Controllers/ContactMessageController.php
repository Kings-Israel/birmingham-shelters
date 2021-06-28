<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Jobs\SendContactMessageResponseMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function contactFormSubmit(Request $request)
    {
        $rules = [
            'message_contact_name' => 'required|string',
            'message_contact_email' => 'required|email',
            'message_contact_subject' => 'required|string',
            'message_contact' => 'required'
        ];

        $messages = [
            'required' => 'Please fill this field',
            'email' => 'Please enter a valid email address',
            'string' => 'Please enter a valid input'
        ];

        $validated_data = $request->validate($rules, $messages);

        if (ContactMessage::create($validated_data)) {
            return back()->with('success', 'Your message has been sent');
        } else {
            return back()->withError('There was a problem while sending your message. Please try again');
        }
    }

    public function contactMessageReply(Request $request)
    {
        $rules = [
            'message_response' => 'required'
        ];

        $messages = [
            'numeric' => 'The input in this field must be a number'
        ];

        $validated_data = $request->validate($rules, $messages);

        SendContactMessageResponseMail::dispatch($request->inquiry_sender_email, $request->inquiry_message, $request->message_response);

        $message = ContactMessage::find($request->inquiry_id);

        $message->is_read = true;

        if($message->save()) {
            return redirect()->back()->with('success', 'Your response has been sent');
        }
    }
}
