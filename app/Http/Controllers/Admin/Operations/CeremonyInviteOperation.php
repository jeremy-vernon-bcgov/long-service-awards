<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Jobs\RsvpInvite;
use App\Models\Attendee;
use App\Models\Ceremony;
use App\Models\Recipient;
use DateTime;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

trait CeremonyInviteOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupCeremonyInviteRoutes($segment, $routeName, $controller)
    {
        Route::post($segment.'/ceremonyinvite', [
            'as'        => $routeName.'.ceremonyInvite',
            'uses'      => $controller.'@ceremonyInvite',
            'operation' => 'ceremonyInvite',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupCeremonyInviteDefaults()
    {
        $this->crud->allowAccess('ceremonyInvite');

        $this->crud->operation('list', function () {
            $this->crud->enableBulkActions();
            $this->crud->addButtonFromView('top', 'email', 'ceremonyinvite', 'beginning');
        });
    }


    /**
     *
     */
    public function ceremonyInvite()
    {
        $this->crud->hasAccessOrFail('ceremonyInvite');
        $entries = $this->crud->getRequest()->input('entries');
        // Last item on array lets us know if this is a test or not.
        $is_test = array_pop($entries);
        // Second last item on array is a custom subject if one was entered.
        $custom_subject = array_pop($entries);
        if($custom_subject === null){
            // This is the standard default subject if a new one was not added.
            $custom_subject = "Response Required: Your Long Service Award Invitation";
        }
        // setup and mail users.
        foreach($entries as $entry=>$value) {
            // get the recipient record.
            $recipient = Recipient::find($value);
            $ceremony = Ceremony::find($recipient->ceremony_id);
            // Allow for testing to lsa email address.
            if($is_test == 'true') {
                $email = 'longserviceawards@gov.bc.ca';
            } else {
                $email = $recipient->government_email;
            }
            // Need the attendee id.
            $attendee = Attendee::where('recipient_id', '=', $value)->firstOrFail();
            // Build array to create email.
            $rsvp_recipient = [
                "name" => $recipient->first_name . ' ' . $recipient->last_name,
                "email" => $email,
                "id" => $attendee->id,
                "ceremony" => new DateTime($ceremony->scheduled_datetime),
                "subject" => $custom_subject,
                "rsvp_url" => URL::to('/') . "/rsvp/" . $value,
                "invite_pdf_url" => URL::to('/') . "/invitation/" . $value
            ];
            RsvpInvite::dispatch($rsvp_recipient);
        }
    }
}

