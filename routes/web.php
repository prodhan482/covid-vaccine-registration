<?php

use App\Http\Controllers\VaccineRegistrationController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\VaccineCenter;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    $vaccineCenters = VaccineCenter::all();
    return view('register', compact('vaccineCenters'));
})->name('register_form');

// Handle the registration form submission
Route::post('/', [VaccineRegistrationController::class, 'register'])->name('register');

// Route for showing the search form
Route::get('/search', [VaccineRegistrationController::class, 'searchForm'])->name('search.form');

// Route for processing the search form
Route::post('/search', [VaccineRegistrationController::class, 'search'])->name('search');

// Check the vaccination status for a user
Route::get('/status/{nid}', function ($nid) {
    $user = User::where('nid', $nid)->first();

    return view('status', compact('user'));
})->name('status');