<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSentMessage
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
     * @param  MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        //Log all sent mails
        $recipient = $event->message->getTo();
        $recipients = '';
        foreach($recipient as $r => $v) {
            $recipients .= $r;
            echo($r);
        }
        $message = "Email sent for: "  . $recipients;
        // Send to email logs
        Log::channel('email')->info($message);
    }

    /**
     * Error handling log
     */
    public function failed(MessageSent $event, $exception){
        // Build message for failure
        $recipient = $event->message->getTo();
        $recipients = '';
        foreach($recipient as $r => $v) {
            $recipients .= $r;
            echo($r);
        }
        $message = "Email failed to send: " . $recipients . " with exception: " . $exception->getMessage();
        // Swift Message
        Log::channel('email')->error($message);
    }
}
