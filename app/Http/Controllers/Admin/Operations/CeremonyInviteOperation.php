<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Jobs\RsvpInvite;
use App\Models\Ceremony;
use App\Models\Recipient;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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
     * Show the view for performing the operation.
     *
     * @return Response
     */

    public function ceremonyInvite()
    {

        $this->crud->hasAccessOrFail('ceremonyInvite');
        $entries = $this->crud->getRequest()->input('entries');
        // setup and mai users
        foreach($entries as $entry=>$value) {
            // get the recipient record
            $recipient = Recipient::find($value);
            $ceremony = Ceremony::find($recipient->ceremony_id);
            $rsvp_recipient = [
                "name" => $recipient->first_name . ' ' . $recipient->last_name,
                "email" => $recipient->government_email,
                "ceremony" => $ceremony->scheduled_datetime,
            ];
            // Mail::to($rsvp_recipient['email'])->queue(new RsvpInvite($rsvp_recipient));
            // Mail::to('thayne.werdal@gov.bc.ca')->queue(new RsvpInvite($rsvp_recipient));
            RsvpInvite::dispatch($rsvp_recipient);
        }
        // return something

    }
}

