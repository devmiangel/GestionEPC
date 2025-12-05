<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Herramienta;
use App\Models\HistorialVehiculo;
use App\Models\HistorialHerramienta;

class HistorialController extends Controller
{
    /**
     * Verifica que el usuario autenticado tenga rol Coordinador o Administrador.
     * Si no, aborta con 403.
     */
    private function authorizeCoordinadorAdmin()
    {
        if (!auth()->check()) {
            abort(403, 'No autorizado.');
        }
        $user = auth()->user();
        if (!($user->tieneRol('Coordinador') || $user->tieneRol('Administrador'))) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }
    }

    public function index()
    {
        $this->authorizeCoordinadorAdmin();
        // Unimos los elementos de vehículos y herramientas para mostrar en el historial
        // Load detalleVehiculo with its estado relation so we can display vehicle state
        $vehiculos = Vehiculo::with(['tipoVehiculo', 'detalleVehiculo.persona', 'detalleVehiculo.estado'])->get()->map(function($v) {
            $detalle = $v->detalleVehiculo->first();
            $tipoVehiculo = $v->tipoVehiculo ? $v->tipoVehiculo->tipo_vehiculo : '';
            $placa = $detalle ? $detalle->placa : '';
            $conductor = $detalle && $detalle->persona
                ? trim($detalle->persona->primer_nombre . ' ' . $detalle->persona->primer_apellido)
                : 'No asignado';
            $estado = 'Desconocido';
            if ($detalle && method_exists($detalle, 'estado') && $detalle->estado) {
                $estado = $detalle->estado->estado ?? $detalle->id_estado ?? 'Desconocido';
            }
            return [
                'id' => $v->id,
                'tipo' => 'Vehículo',
                'marca' => $v->marca_vehiculo ?? '',
                'modelo' => $v->modelo_vehiculo ?? '',
                'tipo_vehiculo' => $tipoVehiculo,
                'placa' => $placa,
                'usuario' => $conductor,
                'nombre' => $placa ?? ($v->nombre ?? ''),
                'fecha_adquisicion' => $v->fecha_adquisicion ?? '',
                'estado' => $estado,
            ];
        });
        $herramientas = Herramienta::with(['tipoHerramienta', 'estado', 'persona'])->get()->map(function($h) {
            $tipo_herramienta = $h->tipoHerramienta ? $h->tipoHerramienta->tipo_herramienta : '';
            $estado = $h->estado ? $h->estado->estado : 'Desconocido';
            $usuario = $h->persona 
                ? trim($h->persona->primer_nombre . ' ' . $h->persona->primer_apellido)
                : 'No asignado';
            
            return [
                'id' => $h->id,
                'tipo' => 'Herramienta',
                'marca' => '',
                'modelo' => $tipo_herramienta,
                'tipo_vehiculo' => '',
                'placa' => '',
                'nombre' => isset($h->nombre) ? $h->nombre : (isset($h->descripcion) ? $h->descripcion : ''),
                'usuario' => $usuario,
                'fecha_adquisicion' => isset($h->fecha_adquisicion) ? $h->fecha_adquisicion : '',
                'estado' => $estado,
            ];
        });
        $items = $vehiculos->concat($herramientas);
        return view('modulos.historial.index', compact('items'));
    }

    public function mantenimientos($id)
    {
        $this->authorizeCoordinadorAdmin();
        // Aquí puedes buscar los mantenimientos por ID y tipo
        // Ejemplo simple:
        // $mantenimientos = Mantenimiento::where('elemento_id', $id)->get();
        // return view('modulos.historial.mantenimientos', compact('mantenimientos'));
    }

    public function editar($id)
    {
        $this->authorizeCoordinadorAdmin();
        // Aquí puedes buscar el elemento y mostrar el formulario de edición
        // Ejemplo simple:
        // $item = ...;
        // return view('modulos.historial.editar', compact('item'));
    }

    public function historialVehiculo($id)
    {
        $this->authorizeCoordinadorAdmin();
        $vehiculo = Vehiculo::findOrFail($id);
        $historial = HistorialVehiculo::where('vehiculo_id', $id)->orderBy('fecha', 'desc')->get();
        return view('modulos.historial.vehiculo', compact('vehiculo', 'historial'));
    }

    public function historialHerramienta($id)
    {
        $this->authorizeCoordinadorAdmin();
        $herramienta = Herramienta::findOrFail($id);
        $historial = HistorialHerramienta::where('herramienta_id', $id)->orderBy('fecha', 'desc')->get();
        return view('modulos.historial.herramienta', compact('herramienta', 'historial'));
    }
}
