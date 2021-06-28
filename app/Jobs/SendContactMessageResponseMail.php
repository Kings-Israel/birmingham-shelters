<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Inquiry;

class SendContactMessageResponseMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $inquiry_sender_email;

    public $inquiry_message;

    public $inquiry_response;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($inquiry_sender_email, $inquiry_message, $inquiry_response)
    {
        $this->inquiry_sender_email = $inquiry_sender_email;
        $this->inquiry_message = $inquiry_message;
        $this->inquiry_response = $inquiry_response;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subject = 'Response to your inquiry';
        Mail::to($this->inquiry_sender_email)->send(new Inquiry($this->inquiry_message, $subject, $this->inquiry_response));
    }
}
