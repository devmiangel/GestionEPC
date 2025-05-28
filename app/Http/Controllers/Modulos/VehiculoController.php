<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\DetalleVehiculo;
use App\Models\TipoVehiculo;

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
        $vehiculos = Vehiculo::with(['detalleVehiculo' => function($query) {
            $query->where('id_estadoregistro', 1); // 1 = visible/activo
        }])->get();
        return view('modulos.vehiculos.eliminar', compact('vehiculos'));
    }

    public function destroy($id)
    {
        try {
            $vehiculo = Vehiculo::findOrFail($id);
            $detalleVehiculo = $vehiculo->detalleVehiculo->first();
            
            if ($detalleVehiculo) {
                $detalleVehiculo->id_estadoregistro = 2; // 2 = oculto/inactivo
                $detalleVehiculo->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Vehículo eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el vehículo'
            ], 500);
        }
    }

    public function camionetas()
    {
        $camionetas = Vehiculo::with(['detalleVehiculo', 'tipoVehiculo'])
            ->where('id_tipovehiculo', 1)
            ->get();
        return view('modulos.vehiculos.tipos.camionetas', compact('camionetas'));
    }

    public function compactadores()
    {
        $compactadores = Vehiculo::with(['detalleVehiculo', 'tipoVehiculo'])
            ->where('id_tipovehiculo', 2)
            ->get();
        return view('modulos.vehiculos.tipos.compactadores', compact('compactadores'));
    }

    public function motos()
    {
        $motos = Vehiculo::with(['detalleVehiculo', 'tipoVehiculo'])
            ->where('id_tipovehiculo', 3)
            ->get();
        return view('modulos.vehiculos.tipos.motos', compact('motos'));
    }

    public function otros()
    {
        $otros = Vehiculo::with(['detalleVehiculo', 'tipoVehiculo'])
            ->where('id_tipovehiculo', 4)
            ->get();
        return view('modulos.vehiculos.tipos.otros', compact('otros'));
    }

    // Formulario de asignación de vehículo
    public function asignarForm()
    {
        $tipos = TipoVehiculo::all();
        $vehiculos = DetalleVehiculo::with('vehiculo')->get();
        $personas = \App\Models\Persona::all();
        return view('modulos.vehiculos.asignar', compact('tipos', 'vehiculos', 'personas'));
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

    public function store(Request $request)
    {
        $request->validate([
            'tipoVehiculo' => 'required|string',
            'marcaVehiculo' => 'required|string',
            'placa' => 'required|string|max:10',
            'modelo' => 'required|string',
            'anio' => 'required|integer',
            'color' => 'required|string',
            'fechaSoat' => 'required|date',
            'fechaSolicitud' => 'required|date',
            'fechaDevolucion' => 'required|date',
            'fechaUltimoMantenimiento' => 'required|date',
            'descripcionUltimoMantenimiento' => 'required|string',
        ]);

        // Map the vehicle type to the corresponding id_tipovehiculo
        $tipoVehiculoMap = [
            'camioneta' => 1,        // camionetas
            'compactador' => 2,   // Compactadores
            'moto' => 3,          // Motos
            'otro' => 4           // Otros
        ];

        // Get the tipo_vehiculo from the database to ensure it exists
        $tipoVehiculo = TipoVehiculo::where('id', $tipoVehiculoMap[$request->tipoVehiculo] ?? 4)->first();
        
        if (!$tipoVehiculo) {
            return redirect()->back()->with('error', 'Tipo de vehículo no válido');
        }

        // Create the vehicle
        $vehiculo = Vehiculo::create([
            'modelo_vehiculo' => $request->modelo,
            'marca_vehiculo' => $request->marcaVehiculo,
            'id_tipovehiculo' => $tipoVehiculo->id,
        ]);

        // Create the vehicle details
        $detalleVehiculo = DetalleVehiculo::create([
            'id_vehiculo' => $vehiculo->id,
            'user_id' => auth()->id(),
            'id_estado' => 1, // Estado activo por defecto
            'id_estadoregistro' => 1, // Estado de registro activo por defecto
            'placa' => $request->placa,
            'fecha_solicitud' => $request->fechaSolicitud,
            'fecha_devolucion' => $request->fechaDevolucion,
            'fecha_soat' => $request->fechaSoat,
            'fecha_ultimo_mantenimiento' => $request->fechaUltimoMantenimiento,
            'descripcion_ultimo_mantenimiento' => $request->descripcionUltimoMantenimiento,
        ]);

        // Handle image upload if present
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imagenData = file_get_contents($imagen->getRealPath());
            $detalleVehiculo->imagen_vehiculo = $imagenData;
            $detalleVehiculo->save();
        }

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo agregado correctamente');
    }

}