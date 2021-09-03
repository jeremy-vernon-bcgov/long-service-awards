<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Award;
use Illuminate\Support\Facades\DB;
use App\Models\Recipient;
use App\Models\PecsfRegion;
use App\Models\PecsfCharity;
use App\Models\AwardOption;
use App\Models\AwardSelection;

class AwardController extends Controller
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


    public function totals()
    {
        /*
        $data['awards'] = DB::table('recipients')
            ->leftJoin('awards', 'recipients.award_id', '=', 'awards.id')
            ->leftJoin('award_selections', 'recipients.id','=','award_selections.recipient_id')
            ->orderBy('recipients.award_id')
            ->get();
        *
         *


        $data['recipients']
        $data['awards_count'] = $this->countAllAwards($data['awards']);
        return view('admin.awardsSelection.awardsSelection')->with('awards', $data['awards_count']);
           */

        $data['columns'][] = ['label' => 'Award Name', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Short name', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Total Recipients', 'orderable' => 'true'];

        $special_case_ids = array_merge($this->pecsf_award_IDs, $this->bracelet_award_IDs, $this->watch_award_IDs);

        $data['awards'] = Award::withCount('recipients')->get();
        $data['awardReceived'] = Recipient::where('award_received', 1)->get()->count();

        return view('admin.awards.totals', $data);

    }



   private  $pecsf_award_IDs = [49, 50, 51,52, 53, 54];
    private  $bracelet_award_IDs = [12, 29, 48];
    private  $watch_award_IDs = [9];

    public function twentyFiveCerts()
    {
        $data['columns'][] = ['label' => 'First', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Name on Cert.' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Org' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Ceremony' , 'orderable' => 'true'];

        $data['recipients'] = Recipient::where('milestone', 25)->with('organization')->get();

        return view('admin.awards.25-certs', $data);
    }

    public function pecsfCerts()
    {
        $data['columns'][] = ['label' => 'First', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Name on Cert.' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Milestone', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Org' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Ceremony' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Edit', 'orderable' => 'false'];


        $data['recipients'] = Recipient::where('award_id', 49)
                                        ->orWhere('award_id', 50)
                                        ->orWhere('award_id', 51)
                                        ->orWhere('award_id', 52)
                                        ->orWhere('award_id', 53)
                                        ->orWhere('award_id', 54)
                                        ->get();

        $certificateNames = [];

        foreach ($data['recipients'] as $recipient) {
            $awardSelections = $recipient->awardSelections;
            foreach ($awardSelections as $selection) {
                if ($selection->award_option_id == 6 || $selection->award_option_id == 7 || $selection->award_option_id == 8 || $selection->award_option_id == 9 || $selection->award_option_id == 10) {
                    if (strlen($selection->value) != 0) :
                    $certificateNames[$recipient->id] = $selection->value;
                    else:
                    $certificateNames[$recipient->id] = 'None Provided';
                    endif;
                }
            }
        }
        $data['certificateNames'] = $certificateNames;

        //TODO: calculate totals for certificate amounts.
        //TODO: calculate total donation qty.

        return view('admin.awards.pecsf-certs', $data);
    }

    public function editPECSFCert($rid) {
        $data['recipient'] = Recipient::find($rid);

        $data['pecsfRegions'] = PecsfRegion::all();
        $data['pecsfCharities'] = PecsfCharity::all();

        return view('admin.awards.pecsf-cert-form', $data);


    }
    public function updatePECSFCert($rid) {
        $recipient = Recipient::find($rid);

        $donationType = new AwardSelection(['award_option_id'   => $this->getAwardOptionforAwardID($recipient->award_id, 'Type')->id,
            'award_id'          => $recipient->award_id,
            'recipient_id'      => $recipient->id]);

        //If charity 2 isn't set - it's a either a 1 charity donation or a regional
        if (!isset($request->charity_2) || !is_numeric($request->charity_2)) :
            //If charity 1 isn't set - it's either invalid or a regional
            if (!isset($request->charity_1) || !is_numeric($request->charity_1)) :
                //If no region is set, it's invalid.
                if (!isset($request->region) || !is_numeric($request->region)) :
                    dd('error');
                else:
                    $donationType->type = 'regional';
                    $donationType->save();
                endif;
            else:
                $donationType->type = 'one-charity';
                $charity1 = new AwardSelection(['award_option_id' => $this->getAwardOptionforAwardID($recipient->award_id, 'Charity-1')->id,
                    'award_id'        => $recipient->award_id,
                    'recipient_id'    => $recipient->id,
                    'value'           => $request->charity_1]);
                $donationType->save();
                $charity1->save();
            endif;
        else:
            $donationType->type = 'two-charity';
            $charity1 = new AwardSelection(['award_option_id' => $this->getAwardOptionforAwardID($recipient->award_id, 'Charity-1')->id,
                                            'award_id'        => $recipient->award_id,
                                            'recipient_id'    => $recipient->id,
                                            'value'           => $request->charity_1]);
            $charity2 = new AwardSelection(['award_option_id' => $this->getAwardOptionforAwardID($recipient->award_id, 'Charity-2')->id,
                'award_id'        => $recipient->award_id,
                'recipient_id'    => $recipient->id,
                'value'           => $request->charity_2]);
            $donationType->save();
            $charity1->save();
            $charity2->save();
        endif;


        if (isset($request->certificate_name)) :
            $certificateName = new AwardSelection(['award_option_id' => $this->getAwardOptionforAwardID($recipient->award_id, 'Cert-Name')->id,
                'award_id'        => $recipient->award_id,
                'recipient_id'    => $recipient->id,
                'value'           => $request->certificate_name]);
            $certificateName->save();
        endif;

        return redirect('/award/pecsf-certs');

    }
    private function getAwardOptionforAwardID($awardID, $optionName) {
        return AwardOption::where('award_id', $awardID)->where('short_name', $optionName);
    }


    public function watches()
    {
        $data['columns'][] = ['label' => 'First', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Ceremony' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Size', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Colour', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Strap' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Engraving' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Edit' , 'orderable' => 'false'];


        $data['recipients'] = Recipient::where('award_id', $this->watch_award_IDs)->with('awardSelections')->get();

        //TODO: I hate this so much.
        $watchSizes = ['38mm face with 20mm strap', '29mm face with 14mm strap'];
        $watchColours = ['Gold', 'Silver', 'Two-Toned (Gold and Silver)'];
        $watchStraps = ['Plated', 'Black Leather', 'Brown Leather'];



        foreach ($watchSizes as $watchSize) {
            foreach($watchColours as $watchColour) {
                foreach ($watchStraps as $watchStrap) {
                    foreach ($data['recipients'] as $recipient) {
                        if (!empty($recipient->awardSelections()->where('award_option_id', 1)->first()) && $recipient->awardSelections()->where('award_option_id', 1)->first()->value == $watchSize) {
                            if ($recipient->awardSelections()->where('award_option_id', 2)->first()->value == $watchColour) {
                                if ($recipient->awardSelections()->where('award_option_id', 3)->first()->value == $watchStrap) {
                                    $watches[$watchSize][$watchColour][$watchStrap][] = $recipient;
                                }
                            }
                        }


                    }
                }
            }

        }
        $data['watchSizes'] = $watchSizes;
        $data['watchColours'] = $watchColours;
        $data['watchStraps'] = $watchStraps;
        if (!empty($watches)) {
            $data['watches'] = $watches;
        }

        return view('admin.awards.watch-order', $data);

        //TODO: calculate totals for each type of watch
        //TODO: calculate totals for each configuration

    }

    public function bracelets()
    {

        $sizes['small'] = ['text' => 'Fits 6 ½″ - 7 ½″ circumference wrists', 'count' => 0];
        $sizes['large'] = ['text' => 'Fits 7 ½″ - 8 ½″ circumference wrists', 'count' => 0];

        $data['recipients'] = Recipient::where('award_id', $this->bracelet_award_IDs[0])
                                                ->orWhere('award_id', $this->bracelet_award_IDs[1])
                                                ->orWhere('award_id', $this->bracelet_award_IDs[2])->get();

        foreach ($data['recipients'] as $recipient) {
            foreach ($sizes as $sizeName => $size) {
                if (!empty($recipient->awardSelections->first()->value)) {
                    if ($recipient->awardSelections->first()->value == $size['text']) {
                        $sizes[$sizeName]['count'] += 1;
                    }
                }
            }
        }

        $data['sizes'] = $sizes;


        $data['columns'][] = ['label' => 'First', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Type' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Size' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Milestone', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Org' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Ceremony' , 'orderable' => 'true'];


        return view('admin.awards.bracelets', $data);

    }

    private function countAllAwards(\Illuminate\Support\Collection $recpients) : array
    {
        //Count of distinct awards
        $award_count = [];
        //Watches/bracelets get their own check.
        //TODO: Awards should get marked if they are a special case when created
        $special_case = [
            '9',
            '12',
            '29',
        ];

        foreach($recpients as $recpient) {
            //TODO: Check if recipient has previous gotten award
            //TODO: Add framed certificates to 25 year awards.
            if (isset($recpient->award_id) && in_array($recpient->award_id, $special_case, false)) :
                // Update the award options to a better format, then search for a match.
                $option = '';
                // Change JSON of watch to associative array


                 $award_options = json_decode($recpient->award->awardOptions, true);
                 dd($award_options);
                    /*
                // TODO: Some awards did not get options. This should not be possible next year - so this could be removed.
                if ($award_options == null) {
                    $option = "none captured";
                }
                else {
                    foreach ($award_options as $details => $value) {
                        //Get rid of watch_engraving - will never match.
                        if ($details == 'watch_engraving') {
                            continue;
                        }
                        $option .= $details . ":" . $value . ", ";
                    }
                }
                    */

                //Now set up our full name
                $special_name = $recpient->award->name . ' - ' . $option;

                //Now we can check for the recrd.
                //If we have one, we can just increment counter.
                if (isset($award_count[$special_name])) {
                    $award_count[$special_name]['award_count'] += 1;
                }
                else {
                    $award_count[$special_name] = [
                        //simple name
                        'award_name' => $award->name,
                        //options - null for this type of award.
                        'award_options' => $option,
                        //Counter
                        'award_count' => 1
                    ];
                }
             else :
                //No need to add anything but the name - no options.
                //Check if we have counted a similar award.
                if(isset($award_count[$recipient->award->name])){
                    //We have one, so just increment the counter.
                    $award_count[$recpient->award->name]['award_count'] += 1;
                }
                else {
                    //We don't have one, set up full name array that contains name, options, count.
                    $award_count[$recipient->award->name] = [
                        //simple name
                        'award_name' => $recipient->award->name,
                        //options - null for this type of award,
                        'award_options' => '',
                        // Counter
                        'award_count' => 1
                    ];
                }
            endif;
        }
        return $award_count;
    }
}
