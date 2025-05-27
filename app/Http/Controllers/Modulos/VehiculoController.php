<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        // Aquí podrías obtener datos desde base de datos si deseas.
        return view('modulos.vehiculos.index');
    }

    public function create()
    {
        return view('modulos.vehiculos.agregar');
    }
}