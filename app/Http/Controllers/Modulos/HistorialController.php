<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Herramienta;

class HistorialController extends Controller
{
    public function index()
    {
        // Unimos los elementos de vehículos y herramientas para mostrar en el historial
        $vehiculos = Vehiculo::all()->map(function($v) {
            return [
                'id' => $v->id,
                'tipo' => 'Vehículo',
                'nombre' => $v->placa,
                'fecha_adquisicion' => $v->fecha_adquisicion,
                'estado' => $v->estado ?? 'Desconocido',
            ];
        });
        $herramientas = Herramienta::all()->map(function($h) {
            return [
                'id' => $h->id,
                'tipo' => 'Herramienta',
                'nombre' => $h->nombre,
                'fecha_adquisicion' => $h->fecha_adquisicion,
                'estado' => $h->estado ?? 'Desconocido',
            ];
        });
        $items = $vehiculos->concat($herramientas);
        return view('modulos.historial.index', compact('items'));
    }

    public function mantenimientos($id)
    {
        // Aquí puedes buscar los mantenimientos por ID y tipo
        // Ejemplo simple:
        // $mantenimientos = Mantenimiento::where('elemento_id', $id)->get();
        // return view('modulos.historial.mantenimientos', compact('mantenimientos'));
    }

    public function editar($id)
    {
        // Aquí puedes buscar el elemento y mostrar el formulario de edición
        // Ejemplo simple:
        // $item = ...;
        // return view('modulos.historial.editar', compact('item'));
    }
}
