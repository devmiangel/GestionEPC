<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;

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

    public function eliminate()
    {
        return view('modulos.vehiculos.eliminar');
    }

    public function camiones()
    {
        $camiones = Vehiculo::with('detalleVehiculo')
                        ->where('id_tipovehiculo', 1)
                        ->get();
        return view('modulos.vehiculos.tipos.camiones', compact('camiones'));
    }

    public function compactadores()
    {
        $compactadores = Vehiculo::with('detalleVehiculo')
                        ->where('id_tipovehiculo', 2)
                        ->get();
        return view('modulos.vehiculos.tipos.compactadores', compact('compactadores'));
    }

    public function motos()
    {
        $motos = Vehiculo::with('detalleVehiculo')
                        ->where('id_tipovehiculo', 3)
                        ->get();
        return view('modulos.vehiculos.tipos.motos', compact('motos'));
    }

    public function otros()
    {
        $otros = Vehiculo::with('detalleVehiculo')
                        ->where('id_tipovehiculo', 4)
                        ->get();
        return view('modulos.vehiculos.tipos.otros', compact('otros'));
    }

}