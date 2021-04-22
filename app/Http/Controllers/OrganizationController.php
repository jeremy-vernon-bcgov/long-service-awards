<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Builder;

class OrganizationController extends Controller
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

    /**
     * List organizations with their recipient breakdowns
     */

    public function recipientTotals()
    {
      $data['organizations'] = Organization::withCount([
        'recipients',
          'recipients as milestone_20_recipients' => function (Builder $query) {
              $query->where('milestone', 20);
        },
          'recipients as milestone_25_recipients' => function (Builder $query) {
            $query->where('milestone', 25);
        },
        'recipients as milestone_30_recipients' => function (Builder $query) {
           $query->where('milestone', 30);
        },
          'recipients as milestone_35_recipients' => function (Builder $query) {
              $query->where('milestone', 35);
        },
          'recipients as milestone_40_recipients' => function (Builder $query) {
              $query->where('milestone', 40);
        },
          'recipients as milestone_45_recipients' => function (Builder $query) {
              $query->where('milestone', 45);
        },
          'recipients as milestone_50_recipients' => function (Builder $query) {
              $query->where('milestone', 50);
        },
      ])->get();

      return view('admin/organizations/recipientTotals', $data);
    }

    public function summary($id = null)
    {
        if (empty($id)) {
            $id = backpack_user()->organization;
        }

        $data['organization'] = Organization::withCount([
           'recipients',
           'recipients as milestone_20_recipients' => function (Builder $query) {
                $query->where('milestone', 20);
           },
           'recipients as milestone_25_recipients' => function (Builder $query) {
                $query->where('milestone', 25);
           },
           'recipients as milestone_30_recipients' => function (Builder $query) {
                $query->where('milestone', 30);
           },
           'recipients as milestone_35_recipients' => function (Builder $query) {
                $query->where('milestone', 35);
           },
           'recipients as milestone_40_recipients' => function (Builder $query) {
                $query->where('milestone', 40);
           },
           'recipients as milestone_45_recipients' => function (Builder $query) {
                $query->where('milestone', 45);
           },
            'recipients as milestone_50_recipients' => function (Builder $query) {
                $query->where('milestone', 50);
           },
        ])->find($id);

        //Recipient counts by office Community


        return view('admin/organizations/summary', $data);
    }
}
