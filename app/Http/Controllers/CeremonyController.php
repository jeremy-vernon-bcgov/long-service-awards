<?php

namespace App\Http\Controllers;

use App\Models\AccessibilityOption;
use App\Models\DietaryRestriction;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Recipient;
use App\Models\Ceremony;
use App\Models\Attendee;

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
            $ceremony['ceremony_of'] = $ceremonyRecord->scheduled_datetime; //TODO: pretty print format date;
            $ceremony['id'] = $ceremonyRecord->id;
            $ceremony['attendees'] = $ceremonyRecord->attendees;
            $ceremony['accessCounts'] = $this->getAccessCounts($ceremonyRecord);
            $ceremony['dietCounts'] = $this->getDietCounts($ceremonyRecord);

            $ceremonies[] = $ceremony;
        }

        $data['ceremonies'] = $ceremonies;

        return view('admin.ceremonies.accommodations', $data);

    }



    private function getAccessCounts($ceremony) {
        $accessibilityOptions = AccessibilityOption::all();
        $accessOptions = [];
        foreach ($accessibilityOptions as $option) {
            $accessOption['short_name'] = $option->short_name;
            $attendees = $ceremony->attendees->has('accessibilityOptions', function (Builder $query) {
                $query->where('id', $option->id);
            });

            $attendees ?  dd($attendees) : $accessOption['quantity'] =  0;

            $accessOptions[] = $accessOption;
        }
        return $accessOptions;
    }
    private function getDietCounts($ceremony) {
        $dietaryRestrictions = DietaryRestriction::all();
        $dietOptions = [];
        foreach ($dietaryRestrictions as $option) {
            $dietOption['short_name'] = $option->short_name;
            $attendees = $ceremony->attendees->has('dietaryRestrictions', function (Builder $query) {
                $query->where('id', $option->id);
            });

            $attendees ?  dd($attendees) : $dietOption['quantity'] =  0;

            $dietOptions[] = $dietOption;
        }
        return $dietOptions;
    }


    public function assign()
    {
        $data['columns'][] = ['label' => 'First', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Org', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Milestone', 'orderable' => 'true'];
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
        $attendee->type = 'recipient';
        $attendee->status = 'assigned';



        $recipient->save();
        if ($attendee->save()) {
            return redirect()->action([CeremonyController::class, 'assign']);
        } else {
            dd($attendee);
        }


    }


    public function allocationTable()
    {
        $data['regions'] = ['Victoria', 'Vancouver', 'Other'];
        $data['milestones'] = [20,25,30,35,40,45,50];
        $data['organizations'] = Organization::all();


    }
}
