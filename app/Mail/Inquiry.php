<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Inquiry extends Mailable
{
    use Queueable, SerializesModels;

    protected $reply;

    protected $inquiry;

    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $inquiry, $subject, $reply)
    {
        $this->reply = $reply;
        $this->subject = $subject;
        $this->inquiry = $inquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.inquiry')->subject($this->subject)->with(['inquiry' => $this->inquiry, 'reply' => $this->reply]);
    }
}
