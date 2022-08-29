<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $details; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $token)
    {
        $this->details = $details;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */ 
    public function build()
    {
        $details = $this->details;
        $token = $this->token;
        return $this->view('sendEmail', compact('details', 'token'));
    }
}
