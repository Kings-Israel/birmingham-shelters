<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInquiryEmailReply implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $subject;
    protected $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $content)
    {
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
        $data = [
            'email' => $this->email,
            'subject' => $this->subject,
            'content' => $this->content,
        ];

        Mail::send('landlord.inquiry-reply-template', $data, function ($message) use ($data) {
            $message->to($this->email);
            $message->replyTo($this->email);
            $message->subject($this->subject);
        });
    }
}
