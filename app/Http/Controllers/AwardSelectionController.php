<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;
use Illuminate\Database\Eloquent\Builder;


class AwardSelectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory
     */
    public function index()
    {
        //Grab all the Awards.
        $data['awards'] = DB::table('recipients')
            ->leftJoin('awards', 'recipients.award_id', '=', 'awards.id')
            ->leftJoin('award_option_selections', 'recipients.id', '=', 'award_option_selections.recipient_id')
            ->orderBy('recipients.award_id')
            ->get();
        $data['awards_count'] = $this->countAllAwards($data['awards']);
        return view('admin.awardsSelection.awardsSelection')->with('awards', $data['awards_count']);

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
     * Function to compile and count each award.
     *   Requires award name, award options and count number.
     *
     * @param \Illuminate\Support\Collection $awards
     * @return array
     */
    private function countAllAwards(\Illuminate\Support\Collection $awards): array
    {
        // We need a count of distinct awards.
        $award_count = [];
        // Watches/bracelets get their own check.
        // TODO: Awards should get marked if they are a special case when created, then this will not need to be updated.
        $special_case = [
            '29', //Bracelet and earrings
            '12', // Sterling silver bracelet
            '9' //Bulova watch
        ];

        foreach($awards as $award) {
            // TODO: Check if user has previously gotten an award.
            // TODO: Add framed certificate to 25 year awards.
            if (isset($award->award_id) && in_array($award->award_id, $special_case,false)){
                // Update the awards options to a better format, then search for a match.
                $option = '';
                // Change json of watch to associative array
                $award_options = json_decode($award->award_options, true);
                // TODO: Some awards did not get options. This should not
                // be possible next year - so this could be removed.
                if($award_options == null ) {
                    $option = "none captured";
                }
                else {

                    foreach ($award_options as $details => $value) {
                        // Get rid of watch_engraving - this will never match.
                        if ($details == 'watch_engraving') {
                            continue;
                        }
                        $option .= $details . ": " . $value . ", ";
                    }
                }

                // Now set up our full name.
                $special_name = $award->name. ' - ' . $option;

                // Now we can check for the record.
                // If we have one, we can just increment counter.
                if(isset($award_count[$special_name])) {
                    $award_count[$special_name]['award_count'] += 1;
                }
                else {
                    $award_count[$special_name] = [
                        // simple name
                        'award_name' => $award->name,
                        // options - null for this type of award.
                        'award_options' => $option,
                        // Counter
                        'award_count' => 1
                    ];
                }
            } else {
                // No need to add in anything other than the name - no options.
                // Check if we have counted a similar award.
                if(isset($award_count[$award->name])){
                    // We have one, so just increment the counter.
                    $award_count[$award->name]['award_count'] += 1;
                }
                else {
                    // We don't have one, set up full name array that contains name, options, count.
                    $award_count[$award->name] = [
                        // simple name
                        'award_name' => $award->name,
                        // options - null for this type of award.
                        'award_options' => '',
                        // Counter
                        'award_count' => 1
                    ];
                }
            }
        }

        return $award_count;
    }
}
