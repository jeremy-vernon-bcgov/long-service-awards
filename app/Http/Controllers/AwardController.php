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
}
