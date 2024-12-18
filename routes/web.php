<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'verify'=> 'true',
]);

Route::get('/verify/account/{id}', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('user.account_verify');
Route::any('/verify/account',  [App\Http\Controllers\Auth\VerificationController::class, 'verifyAccount'])->name('user.account_verification');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
