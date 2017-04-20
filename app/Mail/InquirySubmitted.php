<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InquirySubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $clientEmail;

    public $description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clientEmail, $description)
    {
        $this->clientEmail = $clientEmail;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.inquiry')
            ->from($this->clientEmail)
            ->subject('Custom Statamic Conversion');
    }
}
