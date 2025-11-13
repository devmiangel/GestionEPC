<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\DetalleVehiculo;
use App\Models\Estado;
use App\Models\TipoVehiculo;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('stats');
    }

    /**
     * Show the application dashboard with category buttons.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Preparar estadísticas para mostrar en el dashboard (desplegable)
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

        return view('dashboard', compact(
            'totalVehiculos',
            'vehiculosPorTipo',
            'vehiculosPorEstado',
            'estadoDisponible',
            'estadoPrestado',
            'estadoMantenimiento',
            'estadoFueraServicio'
        ));
    }

    /**
     * Show the application dashboard with vehicle statistics.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stats()
    {
        // Total de vehículos
        $totalVehiculos = Vehiculo::count();
        
        // Vehículos por tipo
        $vehiculosPorTipo = Vehiculo::with('tipoVehiculo')
            ->get()
            ->groupBy('tipoVehiculo.tipo_vehiculo')
            ->map->count()
            ->toArray();
        
        // Vehículos por estado
        $vehiculosPorEstado = DetalleVehiculo::with('estadoVehiculo')
            ->where('id_estadoregistro', 1)
            ->get()
            ->groupBy('estadoVehiculo.estado')
            ->map->count()
            ->toArray();
        
        // Conteos individuales de estados
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
