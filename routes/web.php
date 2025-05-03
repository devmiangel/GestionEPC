<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;

Route::get('/', function () {
    // return view('welcome');
    return "aqui se va a mostrar el inicio de la pagina";
});

Route::get('/login', [loginController::class, 'login']);

Route::get('/home/{usu}', function($usu){
    return "aqui se va a mostrar el home del usuario {$usu}";
});