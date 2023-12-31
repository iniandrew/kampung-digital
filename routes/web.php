<?php

use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\AgendaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing_page');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('changePassword');

    Route::resource('/people', PeopleController::class);

    Route::resource('/user', UserController::class);

    Route::resource('/fund', FundController::class);

    Route::resource('/agenda', AgendaController::class);

    Route::resource('/complaint', ComplaintController::class);
});

Route::middleware(['auth', 'cors'])->group(function () {
    Route::get('/getPeople', [PeopleController::class, 'getData'])->name('people.getData');
    Route::get('/getUser', [UserController::class, 'getData'])->name('user.getData');
    Route::get('/exportFund', [FundController::class, 'export'])->name('fund.export');
    Route::get('/getAgenda', [AgendaController::class, 'getData'])->name('agenda.getData');
});

Route::middleware('auth')->prefix('complaint')->name('complaint.')->group(function () {
    Route::get('{complaint}/review', [ComplaintController::class, 'review'])->name('review');
    Route::put('{complaint}/review', [ComplaintController::class, 'reviewAction'])->name('review.store');
    Route::post('{complaint}/respond', [ComplaintController::class, 'respond'])->name('respond');
});
