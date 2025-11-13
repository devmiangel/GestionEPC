<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use App\Models\DetalleVehiculo;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    /**
     * Display statistics view for vehicles.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalVehiculos = Vehiculo::count();

        $vehiculosPorTipo = Vehiculo::with('tipoVehiculo')
            ->get()
            ->groupBy('tipoVehiculo.tipo_vehiculo')
            ->map->count()
            ->toArray();

        $vehiculosPorEstado = DetalleVehiculo::with('estadoVehiculo')
            ->where('id_estadoregistro', 1)
            ->get()
            ->groupBy('estadoVehiculo.estado')
            ->map->count()
            ->toArray();

        $estadoDisponible = DetalleVehiculo::whereHas('estadoVehiculo', function($q) {
            $q->where('estado', 'disponible');
        })->where('id_estadoregistro', 1)->count();

        $estadoPrestado = DetalleVehiculo::whereHas('estadoVehiculo', function($q) {
            $q->where('estado', 'prestado');
        })->where('id_estadoregistro', 1)->count();

        $estadoMantenimiento = DetalleVehiculo::whereHas('estadoVehiculo', function($q) {
            $q->where('estado', 'en mantenimiento');
        })->where('id_estadoregistro', 1)->count();

        $estadoFueraServicio = DetalleVehiculo::whereHas('estadoVehiculo', function($q) {
            $q->where('estado', 'fuera de servicio');
        })->where('id_estadoregistro', 1)->count();

        return view('stats', compact(
            'totalVehiculos',
            'vehiculosPorTipo',
            'vehiculosPorEstado',
            'estadoDisponible',
            'estadoPrestado',
            'estadoMantenimiento',
            'estadoFueraServicio'
        ));
    }
}
