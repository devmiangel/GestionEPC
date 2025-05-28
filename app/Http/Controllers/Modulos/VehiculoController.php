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

    // Formulario de asignación de vehículo
    public function asignarForm()
    {
        $vehiculos = \App\Models\Vehiculo::all();
        $personas = \App\Models\Persona::all();
        return view('modulos.vehiculos.asignar', compact('vehiculos', 'personas'));
    }

    // Procesar la asignación de vehículo a persona
    public function asignar(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'persona_id' => 'required|exists:personas,id',
        ]);
        $vehiculo = \App\Models\Vehiculo::findOrFail($request->vehiculo_id);
        $vehiculo->persona_id = $request->persona_id;
        $vehiculo->save();
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo asignado correctamente.');
    }

    // Mostrar formulario de edición de vehículo
    public function edit($id)
    {
        $vehiculo = \App\Models\Vehiculo::findOrFail($id);
        return view('modulos.vehiculos.edit', compact('vehiculo'));
    }

    // Procesar actualización de vehículo
    public function update(Request $request, $id)
    {
        $request->validate([
            'placa' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'tipo_vehiculo_id' => 'required|integer',
            'anio' => 'required|integer',
            'color' => 'nullable|string|max:255',
        ]);
        $vehiculo = \App\Models\Vehiculo::findOrFail($id);
        $vehiculo->update($request->all());
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado correctamente.');
    }

}