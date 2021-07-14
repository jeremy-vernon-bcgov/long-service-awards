<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CeremonyController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\OrganizationController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/ceremonies', [CeremonyController::class, 'index']);

Route::get('/recipient/flaggednames', [RecipientController::class, 'showFlaggedNames']);
Route::get('/organization/recipienttotals', [OrganizationController::class, 'recipientTotals']);
Route::get('/organization/summary', [OrganizationController::class, 'summary']);
Route::get('/recipient/orgcheck', [RecipientController::class, 'orgCheck']);
Route::get('/award/totals', [AwardSelectionController::class, 'index']);

/**
 * RSVP form routing.
 */
Route::get('/rsvp/{rid}', [AttendeeController::class, 'rsvpBuild'])->where('id', '[0-9]+');
Route::post('/rsvp', [AttendeeController::class, 'collectRsvp']);
Route::get('rsvp/confirmation/{rid}', [AttendeeController::class, 'confirmationRsvp'])->where('rid', '[0-9]+');

/**
 * PDF routing
 */
Route::get('/generate-pdf/{rid}', [PDFController::class, 'generatePDF'])->name('generate-pdf');

/**
 * Award routing
 */
Route::get('/recipient/award', [RecipientController::class, 'awardList']);
Route::get('/recipient/{rid}/award', [RecipientConttroller::class, 'editAward'])->where('rid', '[0-9]+');
Route::get('/award/totals', [AwardController::class, 'totals']);

/**
 * Dashboard
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
