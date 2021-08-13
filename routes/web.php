<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CeremonyController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\AwardSelectionController;
use App\Http\Controllers\AttendeeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/** ADMIN ROUTES */
Route::middleware('auth')->group(function() {

    Route::get('/recipient/flaggednames', [RecipientController::class, 'showFlaggedNames']);
    Route::get('/organization/recipienttotals', [OrganizationController::class, 'recipientTotals']);
    Route::get('/organization/summary', [OrganizationController::class, 'summary']);
    Route::get('/recipient/orgcheck', [RecipientController::class, 'orgCheck']);


    Route::get('/ceremonies', [CeremonyController::class, 'index']);
    /**
     * Award routing
     */
    Route::get('/recipient/award', [RecipientController::class, 'awardList']);
    Route::get('/recipient/{rid}/award', [RecipientController::class, 'editAward'])->where('rid', '[0-9]+');
    Route::put('/recipient/{rid}/award', [RecipientController::class, 'updateAward'])->where('rid', '[0-9]+');
    Route::get('/award/totals', [AwardController::class, 'totals']);
    Route::get('/award/25certs', [AwardController::class, 'twentyFiveCerts']);
    Route::get('/award/pecsf-certs', [AwardController::class, 'pecsfCerts']);
    Route::get('/award/watches', [AwardController::class, 'watches']);
    Route::get('/award/bracelets', [AwardController::class, 'bracelets']);
    Route::get('/award/updatepecsf/{rid}', [AwardController::class, 'editPECSFCert'])->where('rid', '[0-9]+');
    Route::post('/award/updatepecsf/{rid}', [AwardController::class, 'editPECSFCert'])->where('rid', '[0-9]+');





    /**
     * Ceremony Routing
     */
    Route::get('/ceremony/assign', [CeremonyController::class, 'assign']);
    Route::post('/ceremony/assign/{rid}', [CeremonyController::class, 'assignUpdate']);
    Route::get('/ceremony/accommodations' , [CeremonyController::class, 'accommodations']);
    Route::get('/ceremony/rsvpstatus', [AttendeeController::class, 'rsvpStatus']);
    Route::post('/attendee/updatersvp/{rid}', [AttendeeController::class, 'updateRSVPStatus'])->where('rid', '[0-9]+');

    /**
     * Dashboard
     */
    Route::redirect('/dashboard', '/admin/recipient');

});



/** END USER ROUTES */

Route::get('/', function () {
    return view('welcome');
});




//RSVP form routing.
Route::post('/rsvp', [AttendeeController::class, 'collectRsvp']);
Route::get('/rsvp/{identifier}', [AttendeeController::class, 'rsvpBuild']);

Route::get('rsvp/confirmation/{rid}', [AttendeeController::class, 'confirmationRsvp']);

//PDF routing
Route::get('/generate-pdf/{rid}', [PDFController::class, 'generatePDF'])->name('generate-pdf');



require __DIR__.'/auth.php';
