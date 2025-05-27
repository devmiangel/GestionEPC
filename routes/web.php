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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
    Route::get('/vehiculos/agregar', [VehiculoController::class, 'create'])->name('vehiculos.create');
    Route::get('/vehiculos/eliminar', [VehiculoController::class, 'eliminate'])->name('vehiculos.eliminate');
    Route::get('/vehiculos/camiones', [VehiculoController::class,'camiones'])->name('vehiculos.camiones');
    Route::get('/vehiculos/compactadores', [VehiculoController::class,'compactadores'])->name('vehiculos.compactadores');
    Route::get('/vehiculos/motos', [VehiculoController::class, 'motos'])->name('vehiculos.motos');
    Route::get('/vehiculos/otros', [VehiculoController::class,'otros'])->name('vehiculos.otros');
});

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
