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

class SendInquiryReplyMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $inquiry;
    protected $email;
    protected $subject;
    protected $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($inquiry, $email, $subject, $content)
    {
        $this->inquiry = $inquiry;
        $this->email = $email;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new Inquiry($this->inquiry, $this->subject, $this->content));
    }
}
