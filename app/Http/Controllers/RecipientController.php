<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recipient;
use App\Models\Award;
use App\Models\AwardSelection;
use App\Models\Organization;

class RecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    private $pecsf_award_ids = ['49','50','51','52','53', '54'];
    private $watch_award_ids = ['9'];
    private $bracelet_award_ids = ['12','29', '48'];


    public function awardList()
    {
        $data['recipients'] = Recipient::with('award', 'organization')->get();
        $data['columns'][] = ['label' => 'First', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Org' ,  'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Award', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Edit', 'orderable' => 'false'];

        return view('admin.recipients.recipientAwards', $data);
    }

    public function editAward($id)
    {

        $data['awards'] = Award::all();
        $data['recipient'] = Recipient::with('awardSelections')->find($id);

        //Option values
        if (in_array($data['recipient']->award_id, $this->pecsf_award_ids)) {
            $data['certificate_name'] = AwardSelection::where('recipient_id', $data['recipient']->id)->first()->value;
        }
        if (in_array($data['recipient']->award_id, $this->watch_award_ids)) {

                if ($watchSize = AwardSelection::where('recipient_id', $data['recipient']->id)->where('award_option_id', 1)->first()) :
                    $data['watch_size']      = $watchSize->value;
                endif;
                if ($watchColour = AwardSelection::where('recipient_id', $data['recipient']->id)->where('award_option_id', 2)->first()) :
                    $data['watch_colour']    = $watchColour->value;
                endif;

                if ($watchStrap = AwardSelection::where('recipient_id', $data['recipient']->id)->where('award_option_id', 3)->first()) :
                    $data['watch_strap']     = $watchStrap->value;
                endif;

                if ($watchEngraving = AwardSelection::where('recipient_id', $data['recipient']->id)->where('award_option_id', 4)->first()) :
                    $data['watch_engraving'] = $watchEngraving->value;
                endif;

        }
        if (in_array($data['recipient']->award_id, $this->bracelet_award_ids)) {
            if (!empty(AwardSelection::where('recipient_id', $id)->get()->first()->value))
            {
                $data['bracelet_size'] = AwardSelection::where('recipient_id', $id)->get()->first()->value;
            }
        }

        return view('admin.recipients.editAward', $data);
    }

    public function updateAward(Request $request, $id)
    {
        //remove old award selections
        AwardSelection::where('recipient_id', $id)->delete();

        if (in_array($request->award_id, $this->pecsf_award_ids)) {
            $this->updatePecsfCertOptions($request, $id);
        }
        if (in_array($request->award_id, $this->watch_award_ids)) {
            $this->updateWatchOptions($request, $id);
        }
        if (in_array($request->award_id, $this->bracelet_award_ids)) {
            $this->updateBraceletOptions($request, $id);
        }

        $recipient = Recipient::find($id);
        $recipient->award_id = $request->award_id;
        $recipient->save();



        return redirect()->action([RecipientController::class, 'awardList']);
    }

    private function updatePecsfCertOptions(Request $request, $recipient_id)
    {


        $certificateName = new AwardSelection;
        $certificateName->recipient_id = $recipient_id;
        $certificateName->award_id = $request->award_id;

        switch ($request->award_id) {
            case 49:
                $certificateName->award_option_id = 5;
                break;
            case 50:
                $certificateName->award_option_id = 6;
                break;
            case 51:
                $certificateName->award_option_id = 7;
                break;
            case 52:
                $certificateName->award_option_id = 8;
                break;
            case 53:
                $certificateName->award_option_id = 9;
                break;
            case 54:
                $certificateName->award_option_id = 10;
                break;
        }

        $certificateName->value = $request->certificate_name;
        $certificateName->save();


    }
    private function updateWatchOptions(Request $request, $recipient_id)
    {


        //Size
        $watchSize = new AwardSelection;
        $watchSize->recipient_id = $recipient_id;
        $watchSize->award_id = $request->award_id;
        $watchSize->award_option_id = 1;
        $watchSize->value = $request->watch_size;

        //watch colour
        $watchColour = new AwardSelection;
        $watchColour->recipient_id = $recipient_id;
        $watchColour->award_id = $request->award_id;
        $watchColour->award_option_id = 2;
        $watchColour->value = $request->watch_colour;

        //Strap
        $watchStrap = new AwardSelection;
        $watchStrap->recipient_id = $recipient_id;
        $watchStrap->award_id = $request->award_id;
        $watchStrap->award_option_id = 3;
        $watchStrap->value = $request->watch_strap;

        //engraving
        $watchEngraving = new AwardSelection;
        $watchEngraving->recipient_id = $recipient_id;
        $watchEngraving->award_id = $request->award_id;
        $watchEngraving->award_option_id = 4;
        $watchEngraving->value = $request->watch_engraving;

        $watchSize->save();
        $watchColour->save();
        $watchStrap->save();
        $watchEngraving->save();


    }
    private function updateBraceletOptions(Request $request, $recipient_id)
    {


        $braceletSize = new AwardSelection;
        $braceletSize->recipient_id = $recipient_id;
        $braceletSize->award_id = $request->award_id;

        $braceletSize->value = $request->bracelet_size;



        switch($request->award_id) {
            case 12:
                $braceletSize->award_option_id = 11;
                break;
            case 29:
                $braceletSize->award_option_id  = 29;
                break;
            case 48:
                $braceletSize->award_option_id = 48;
                break;
        }

        $braceletSize->save();


    }




    /**
     * Display a list of names that do not conform to usual naming standards
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function showFlaggedNames()
    {


        //Get all recipients
        $recipients = Recipient::all();


        //Extract all with name strings with multiple capital letters in a row
        $multicaps = $recipients->filter(function ($recipient) {
            $multicap_regex = "/\w*[A-Z]\w*[A-Z]\w*/";
            if (preg_match($multicap_regex, $recipient->first_name) || preg_match($multicap_regex, $recipient->last_name)) {
                return $recipient;
            }
        });


        //Extract all recipients with names that do not contain capital letters.
        $nocaps = $recipients->filter(function($recipient) {
            $cap_regex = "/[A-Z]/";
            if (!(preg_match($cap_regex, $recipient->first_name)) || !(preg_match($cap_regex, $recipient->last_name))) {
                return $recipient;
            }
        });

        //Extract all with name strings with characters are are not letters, hyphens, spaces or apostrophes.

        $special_chars = $recipients->filter(function($recipient) {
            $no_special_char_regex = "/^[a-zA-Z'\s-]*$/";
            if (!(preg_match($no_special_char_regex, $recipient->first_name)) || !(preg_match($no_special_char_regex, $recipient->last_name))) {
                return $recipient;
            }
        });

        $flagged_recipients = $multicaps->merge($nocaps);
        $data['recipients'] = $flagged_recipients->merge($special_chars);

        return view('admin/recipients/showFlagged', $data);


    }

    public function rsvpStatus()
    {
        $data['recipients'] = Recipient::all();
        $data['columns'][] = ['label' => 'First', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Org' ,  'orderable' => 'true'];
        $data['columns'][] = ['label' => 'RSVP', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Guest', 'orderable' => 'false'];
        $data['columns'][] = ['label' => 'Gov Email', 'orderable' => 'false'];
        $data['columns'][] = ['label' => 'Personal Email', 'orderable' => 'false'];
        $data['columns'][] = ['label' => 'Contact Pref.', 'orderable' => 'true'];

        return view('admin.recipients.rsvpStatus', $data);


    }



    /**
     * Displays a view of recipients sorted by organization.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function orgCheck()
    {
        $data['recipients'] = Recipient::all();



        return view('admin/recipients/orgCheck', $data);
    }


}
