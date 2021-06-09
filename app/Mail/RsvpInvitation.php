<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RsvpInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The RSVP instance.
     *
     * @var
     */
    public $rsvp_recipient;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rsvp_recipient)
    {
        $this->rsvp_recipient = $rsvp_recipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject($this->rsvp_recipient['subject'])
                    ->view('emails.rsvp-invitation',["data"=>$this->rsvp_recipient]);
    }
}
