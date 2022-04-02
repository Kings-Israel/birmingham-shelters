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

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $data = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->get('recaptcha'),
            'remoteip' => $remoteip
        ];
        $options = [
            'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        $validated_data = $request->validate($rules, $messages);

        if ($resultJson->success != true) {
            return back()->withErrors(['captcha' => 'ReCaptcha Error']);
        }
        if ($resultJson->score >= 0.4) {
            if (ContactMessage::create($validated_data)) {
                return back()->with('success', 'Thank you for your message.');
            } else {
                return back()->withError('There was a problem while sending your message. Please try again');
            }
        } else {
            return back()->withErrors(['captcha' => 'ReCaptcha Error']);
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
