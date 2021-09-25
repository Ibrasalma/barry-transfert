<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Crud;
use App\Http\Livewire\Versement;
use App\Http\Livewire\Depot;
use App\Http\Livewire\Compte;
use App\Http\Livewire\Facture;
use App\Http\Livewire\TransfertPayed;
use App\Http\Livewire\TransfertNotPayed;
use App\Http\Livewire\Payment;
use App\Http\Livewire\VersementPayed;
use App\Http\Livewire\VersementNotPayed;
use App\Http\Controllers\Depot as DepotController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('clients', Crud::class)->name('clients');

Route::get('comptes', Compte::class)->name('comptes');

Route::get('depots', Depot::class)->name('depots');

Route::get('depots_paid', VersementPayed::class)->name('depots_paid');

Route::get('depots_not_paid', VersementNotPayed::class)->name('depots_not_paid');

Route::get('versements', Versement::class)->name('versements');

Route::get('factures', Facture::class)->name('factures');

Route::get('payements', Payment::class)->name('payements');

Route::get('transferts_paid', TransfertPayed::class)->name('transferts_paid');
Route::get('transferts_not_paid', TransfertNotPayed::class)->name('transferts_not_paid');