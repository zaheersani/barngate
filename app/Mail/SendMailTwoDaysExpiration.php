<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailTwoDaysExpiration extends Mailable
{
    use Queueable, SerializesModels;

    public $saleM;
    public $subject = "Your plan is about to expire";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($saleM)
    {
        $this->saleM = $saleM;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.emails.check-two-expiration-date');
    }
}
