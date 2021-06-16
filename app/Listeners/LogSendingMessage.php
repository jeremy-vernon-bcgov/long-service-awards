<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSendingMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSending  $event
     * @return void
     */
    public function handle(MessageSending $event)
    {
        //Log all queued mails
        $recipient = $event->message->getTo();
        $recipients = '';
        foreach($recipient as $r => $v) {
            $recipients .= $r;
        }
        $message = "Email queued to send for: "  .  $recipients;
        // Send to email logs
        Log::channel('email')->info($message);
    }

    /**
     * Error handling log
     */
    public function failed(MessageSending $event, $exception){
        // Build message for failure
        // get the send address(es)
        $recipient = $event->message->getTo();
        $recipients = '';
        foreach($recipient as $r => $v) {
            $recipients .= $r;
        }
        $message = "Email failed to queue: " . $recipients . " with exception: " . $exception->getMessage();
        // Swift Message
        Log::channel('email')->error($message);
    }
}
