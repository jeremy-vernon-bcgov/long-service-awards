<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Award;
use App\Models\Recipient;

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
        $data['columns'][] = ['label' => 'Award Type', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Total Recipients', 'orderable' => 'true'];
        $data['awards'] = Award::withCount('recipients')->get();
        return view('admin.awards.totals', $data);
    }

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

        $pecsf_award_IDs = [49, 50, 51,52, 53, 54];

        $data['recipients'] = Recipient::where('award_id', $pecsf_award_IDs)->get();

        //TODO: calculate totals for certificate amounts.
        //TODO: calculate total donation qty.

        return view('admin.awards.pecsf-certs', $data);
    }

    public function watches()
    {
        $data['columns'][] = ['label' => 'First', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Type', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Engraving' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Milestone', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Strap Size' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Ceremony' , 'orderable' => 'true'];

        $watch_award_ids = [9];
        $data['recipients'] = Recipient::where('award_id', $watch_award_ids)->get();

        //TODO: calculate totals for each type of watch
        //TODO: calculate totals for each configuration

    }

    public function bracelets()
    {
        $data['columns'][] = ['label' => 'First', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Type' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Size' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Milestone', 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Org' , 'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Ceremony' , 'orderable' => 'true'];

        $bracelet_award_ids = [];
        $data['recipients'] = Recipient::where('award_id', $bracelet_award_ids)->get();

    }
}
