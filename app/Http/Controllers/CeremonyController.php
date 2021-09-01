<?php

namespace App\Http\Controllers;

use App\Models\AccessibilityOption;
use App\Models\DietaryRestriction;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Recipient;
use App\Models\Ceremony;
use App\Models\Attendee;
use DateTime;

class CeremonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/ceremonies/allocateIndex-mockup');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function accommodations()
    {



        $ceremonies = [];
        foreach (Ceremony::all() as $ceremonyRecord) {
            $ceremony['ceremony_of'] = new DateTime($ceremonyRecord->scheduled_datetime); //TODO: pretty print format date;
            $ceremony['id'] = $ceremonyRecord->id;
            $ceremony['attendees'] = $ceremonyRecord->attendees->where('status', 'attending');
            $ceremony['accessCounts'] = $this->getAccessCounts($ceremonyRecord);
            $ceremony['dietCounts'] = $this->getDietCounts($ceremonyRecord);

            $ceremonies[] = $ceremony;
        }

        $data['ceremonies'] = $ceremonies;

        return view('admin.ceremonies.accommodations', $data);

    }

    //TODO: getAccessCounts and getDietCounts are practically identical in implementation - perhaps can be consolidated?


    private function getAccessCounts($ceremony) {

        //TODO: Brute-force and ignorance method used. This 3 nested iterators - can likely be optimized.

        $accessibilityOptions = AccessibilityOption::all();
        $accessOptions = [];

        foreach ($accessibilityOptions as $accessibilityOption) :
            $count = 0;
            foreach ($ceremony->attendees as $attendee) :

                if ($attendee->accessibilityOptions->count() > 0) {
                    foreach ($attendee->accessibilityOptions as $attendeeOption) :
                        if ($attendeeOption->short_name == $accessibilityOption->short_name) {
                            $count++;
                        }
                    endforeach; //attendee selections
                }
            endforeach; //attendees
            $optionCount['short_name'] = $accessibilityOption->short_name;
            $optionCount['quantity']   = $count;
            $accessOptions[] = $optionCount;
        endforeach; //accessiblityOptions
    return $accessOptions;

    }
    private function getDietCounts($ceremony) {

        //TODO: Brute-force and ignorance method used. This 3 nested iterators - can likely be optimized.

        $dietaryRestrictions = DietaryRestriction::all();
        $dietOptions = [];

        foreach ($dietaryRestrictions as $option) :
            $count = 0;
            foreach ($ceremony->attendees as $attendee) :
              if ($attendee->dietaryRestrictions->count() > 0) {
                  foreach ($attendee->dietaryRestrictions as $attendeeDiet) :
                      if ($attendeeDiet->short_name == $option->short_name) {
                          $count++;
                      }
                  endforeach; //attendee selections
              }
              endforeach; //attendees
                $optionCount['short_name'] = $option->short_name;
                $optionCount['quantity'] = $count;
                $dietOptions[] = $optionCount;
        endforeach; //dietaryRestrictions
        return $dietOptions;
    }

    public function responseRatesByCeremony() {
        $data['columns'][] = ['label' => 'ceremony'         , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'assigned'         , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'invited'          , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'attending'        , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'guests'           , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'attendees'        , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'declined'         , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'RSVPed'           , 'orderable' => 'true'];

        $data['ceremonies'] = Ceremony::all();


        return view('admin.ceremonies.responseByCeremony', $data);
    }

    public function responseRatesByOrganization() {

        $data['columns'][] = ['label' => 'organization'  , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'recipients'    , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'assigned'      , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'attending'     , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'attendees'     , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'declined'      , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'RSVPed'       , 'orderable' => 'true'];

        $data['organizations'] = Organization::with('recipients')->all();

        return view('admin.ceremonies.responseByOrganization', $data);
    }


    public function assign()
    {
        $data['columns'][] = ['label' => 'First', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Org', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Milestone', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Accomm', 'orderable' => 'false'];
        $data['columns'][] = ['label' => 'Ceremony', 'orderable' => 'true'];


        $data['assigned_recipients'] = Recipient::has('ceremony')->orderBy('updated_at')->get();
        $data['unassigned_recipients'] = Recipient::doesntHave('ceremony')->orderBy('updated_at')->get();
        $data['ceremonies'] = Ceremony::all();

        return view('admin.ceremonies.assignRecipients', $data);
    }

    public function assignUpdate(Request $request, $rid)
    {


        $recipient = Recipient::find($rid);
        $recipient->ceremony_id = $request->ceremony_id;

        //We only want one attendee record per recipient.
        if (!empty($recipient->attendee)) {
            $attendee = $recipient->attendee;
        } else {
            $attendee = new Attendee;
        }

        $attendee->recipient_id = $rid;
        $attendee->ceremony_id = $request->ceremony_id;
        $attendee->identifier = $this->generateAttendeeIdentifier(24);
        $attendee->type = 'recipient';
        $attendee->status = 'assigned';



        $recipient->save();
        if ($attendee->save()) {
            return redirect()->action([CeremonyController::class, 'assign']);
        } else {
            dd($attendee);
        }


    }

    private function generateAttendeeIdentifier($length = 24) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function allocationTable()
    {
        $data['regions'] = ['Victoria', 'Vancouver', 'Other'];
        $data['milestones'] = [20,25,30,35,40,45,50];
        $data['organizations'] = Organization::all();


    }
}
