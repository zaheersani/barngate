<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $msj;
    public $subject = "Register";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msj)
    {
        $this->msj = $msj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.emails.message-register');
    }
}
