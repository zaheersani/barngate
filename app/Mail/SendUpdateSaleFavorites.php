<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUpdateSaleFavorites extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject = "change in your favorites";
    public $saleUp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $saleUp)
    {
        $this->user = $user;
        $this->saleUp = $saleUp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->view('site.emails.send-update-favorites');
    }
}
