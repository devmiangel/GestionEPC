<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Modulos\VehiculoController;


Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
});

Route::get('/vehiculos/agregar', [VehiculoController::class, 'create'])->name('vehiculos.create');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::post('/auth', [AuthController::class, 'handle'])->name('auth.handle');

Route::get('/password/reset', function () {
    return view('auth.verycontra');
})->name('password.request');

Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
