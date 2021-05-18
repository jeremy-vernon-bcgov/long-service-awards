<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\CeremonyController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\AwardSelectionController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/ceremonies', [CeremonyController::class, 'index']);

Route::get('/recipient/flaggednames', [RecipientController::class, 'showFlaggedNames']);
Route::get('/organization/recipienttotals', [OrganizationController::class, 'recipientTotals']);
Route::get('/organization/summary', [OrganizationController::class, 'summary']);
Route::get('/recipient/orgcheck', [RecipientController::class, 'orgCheck']);
Route::get('/admin/totals', [AwardSelectionController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
