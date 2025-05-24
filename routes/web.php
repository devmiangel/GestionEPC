<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();}

Route::get('/login', function () {
    return view('login');
});


Auth::routes(['reset' => false]);

Route::get('/password/reset', function () {
    return view('auth.verycontra');
})->name('password.request');

Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');


Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');