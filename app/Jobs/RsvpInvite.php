<?php

namespace App\Jobs;

use App\Mail\RsvpInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RsvpInvite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The mail instance
     *
     * @return void
     */
    protected $rsvp_recipient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($rsvp_recipient)
    {
        $this->rsvp_recipient = $rsvp_recipient;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new RsvpInvitation($this->rsvp_recipient);
        Mail::to('thayne.werdal@gov.bc.ca')->send($email);
    }
}
