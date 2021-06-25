<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Ceremony;
use App\Models\Recipient;
use DateTime;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use PDF;


class PDFController extends Controller
{
    /**
     * Display a listing of the resource
     *  controller taken from this tutorial: https://www.itsolutionstuff.com/post/laravel-8-pdf-laravel-8-generate-pdf-file-using-dompdfexample.html
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(int $id)
    {
        // Grab attendee - then we can get recipient.
        $attendee = Attendee::find($id);
        $recipient = Recipient::find($attendee->recipient_id);
        $name = $recipient->first_name . ' ' . $recipient->last_name;
        $ceremony = Ceremony::find($recipient->ceremony_id);

        $data = [
            'name' => $name,
            'date' => new DateTime($ceremony->scheduled_datetime),
        ];

        $pdf = PDF::loadView('pdf/lsaPDF', $data);

        return $pdf->download('lsa.pdf');
    }
}
