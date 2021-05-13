<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recipient;

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

        return view ('admin/recipients/showFlagged', $data);


    }

    public function orgCheck()
    {
        $data['recipients'] = Recipient::all();

        return view('admin/recipients/orgCheck', $data);
    }


}
