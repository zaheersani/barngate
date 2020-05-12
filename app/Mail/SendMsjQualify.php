<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMsjQualify extends Mailable
{
    use Queueable, SerializesModels;

    public $msj;
    public $subject = "Rate your seller";
    public $username;
    public $sale_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msj, $username, $sale_id)
    {
         $this->msj      = $msj;
         $this->username = $username;
         $this->sale_id  = $sale_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.emails.qualifyRate');
    }
}
