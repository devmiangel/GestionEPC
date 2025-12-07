<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\DetalleVehiculo;
use App\Models\TipoVehiculo;
use App\Models\Estado;
use App\Models\Persona;


class VehiculoController extends Controller
{
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
        return view('modulos.vehiculos.index');
    }
    
    public function camionetas()
    {
        $camionetas = Vehiculo::with(['detalleVehiculo.persona', 'detalleVehiculo.estado', 'tipoVehiculo'])
            ->where('id_tipovehiculo', 1)
            ->get();
        return view('modulos.vehiculos.tipos.camionetas', compact('camionetas'));
    }

    public function compactadores()
    {
        $compactadores = Vehiculo::with(['detalleVehiculo.persona', 'detalleVehiculo.estado', 'tipoVehiculo'])
            ->where('id_tipovehiculo', 2)
            ->get();
        return view('modulos.vehiculos.tipos.compactadores', compact('compactadores'));
    }

    public function motos()
    {
        $motos = Vehiculo::with(['detalleVehiculo.persona', 'detalleVehiculo.estado', 'tipoVehiculo'])
            ->where('id_tipovehiculo', 3)
            ->get();
        return view('modulos.vehiculos.tipos.motos', compact('motos'));
    }

    public function otros()
    {
        $otros = Vehiculo::with(['detalleVehiculo.persona', 'detalleVehiculo.estado', 'tipoVehiculo'])
            ->where('id_tipovehiculo', 4)
            ->get();
        return view('modulos.vehiculos.tipos.otros', compact('otros'));
    }

    public function create(Request $request)
    {
        $this->authorizeCoordinadorAdmin();
        $tipoSeleccionado = $request->input('tipo_vehiculos') ?? $request->input('tipo') ?? null;
        return view('modulos.vehiculos.actions.agregar', compact('tipoSeleccionado'));
    }

    public function store(Request $request)
    {
        $this->authorizeCoordinadorAdmin();
        $request->validate([
            'modelo' => 'required|string',
            'marcaVehiculo' => 'required|string',
            'anio' => 'required|integer',
            'tipo_vehiculos' => 'required|string',
            'placa' => 'required|string|max:20',
            'fechaSoat' => 'required|date',
            'fecha_tecnomecanica' => 'required|date',
            'fechaUltimoMantenimiento' => 'nullable|date',
            'descripcionUltimoMantenimiento' => 'nullable|string',
            'persona_id' => 'nullable|exists:personas,id',
        ]);
        $tipoVehiculoMap = [
            'Camionetas' => 1,
            'Compactadores' => 2,
            'Motos' => 3,
            'Otro' => 4
        ];

    $tipoVehiculoKey = $request->input('tipo_vehiculos');
    $tipoVehiculo = TipoVehiculo::where('id', $tipoVehiculoMap[$tipoVehiculoKey] ?? 4)->first();
        
        if (!$tipoVehiculo) {
            return redirect()->back()->with('error', 'Tipo de vehículo no válido');
        }

        $vehiculo = Vehiculo::create([
            'modelo_vehiculo' => $request->modelo,
            'marca_vehiculo' => $request->marcaVehiculo,
            'anio' => $request->anio,
            'id_tipovehiculo' => $tipoVehiculo->id,
        ]);

        $detalleVehiculo = DetalleVehiculo::create([
            'id_vehiculo' => $vehiculo->id,
            'persona_id' => $request->persona_id ?? null,
            'id_estado' => 1,
            'id_estadoregistro' => 1,
            'placa' => $request->placa,
            'fecha_soat' => $request->fechaSoat,
            'fecha_tecnomecanica' => $request->input('fecha_tecnomecanica'),
            'fecha_solicitud' => $request->fechaSolicitud ?? null,
            'fecha_devolucion' => $request->fechaDevolucion ?? null,
            'fecha_ultimo_mantenimiento' => $request->fechaUltimoMantenimiento ?? null,
            'descripcion_ultimo_mantenimiento' => $request->descripcionUltimoMantenimiento ?? null,
        ]);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imagenData = file_get_contents($imagen->getRealPath());
            $detalleVehiculo->imagen_vehiculo = $imagenData;
            $detalleVehiculo->save();
        }

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo agregado correctamente');
    }

    public function edit($id)
    {
        $this->authorizeCoordinadorAdmin();
        $vehiculo = \App\Models\Vehiculo::findOrFail($id);
        return view('modulos.vehiculos.edit', compact('vehiculo'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeCoordinadorAdmin();
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

    public function eliminate()
    {
        $this->authorizeCoordinadorAdmin();
        $vehiculos = Vehiculo::with(['detalleVehiculo' => function($query) {
            $query->where('id_estadoregistro', 1); // 1 = visible/activo
        }])->get();
        return view('modulos.vehiculos.actions.eliminar', compact('vehiculos'));
    }

    public function destroy(Request $request, $id)
    {
        $this->authorizeCoordinadorAdmin();
        \DB::beginTransaction();
        try {
            $vehiculo = Vehiculo::findOrFail($id);
            $detalleVehiculo = $vehiculo->detalleVehiculo()->first();

            if ($detalleVehiculo) {
                $detalleVehiculo->delete();
            }

            $vehiculo->delete();

            \DB::commit();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vehículo eliminado correctamente'
                ]);
            }

            return redirect()->route('vehiculos.eliminate')->with('success', 'Vehículo eliminado correctamente');
        } catch (\Exception $e) {
            \DB::rollBack();
            if (isset($request) && ($request->wantsJson() || $request->ajax())) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al eliminar el vehículo: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Error al eliminar el vehículo');
        }
    }

    public function show($id)
    {
        $vehiculo = Vehiculo::with(['detalleVehiculo.estado', 'detalleVehiculo.persona'])->findOrFail($id);
        $estados = Estado::all();
        return view('modulos.vehiculos.actions.show', compact('vehiculo', 'estados'));
    }

    public function cambiarEstado(Request $request, Vehiculo $vehiculo)
    {
        $this->authorizeCoordinadorAdmin();
        $detalleVehiculo = $vehiculo->detalleVehiculo;
        $detalleVehiculo->id_estado = $request->id_estado;
        $detalleVehiculo->save();
    
        return redirect()->back()->with('success', 'Estado del vehículo actualizado correctamente');
    }

    public function asignarForm()
    {
        $this->authorizeCoordinadorAdmin();
        $tipos = TipoVehiculo::all();
        $estadoDisponible = Estado::where('estado', 'Disponible')->first();
        $idEstadoDisponible = $estadoDisponible ? $estadoDisponible->id : 1; // fallback a 1 si no existe
        $vehiculos = DetalleVehiculo::with('vehiculo')
            ->where('id_estado', $idEstadoDisponible)
            ->where('id_estadoregistro', 1)
            ->get();
        $personas = Persona::all();
        return view('modulos.vehiculos.actions.asignar', compact('tipos', 'vehiculos', 'personas'));
    }

    public function asignar(Request $request)
    {
        $this->authorizeCoordinadorAdmin();
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'persona_id' => 'required|exists:personas,id',
        ]);
        $detalle = \App\Models\DetalleVehiculo::where('id_vehiculo', $request->vehiculo_id)
            ->where('id_estadoregistro', 1)
            ->first();
        if ($detalle) {
            $detalle->persona_id = $request->persona_id;
            $estadoPrestado = Estado::where('estado', 'prestado')->first();
            if ($estadoPrestado) {
                $detalle->id_estado = $estadoPrestado->id;
            }
            $detalle->save();
            \App\Models\HistorialVehiculo::create([
                'vehiculo_id' => $detalle->vehiculo->id,
                'tipo_evento' => 'prestamo',
                'fecha' => now(),
                'descripcion' => 'Vehículo asignado a persona ID: ' . $request->persona_id,
                'usuario_id' => auth()->id(),
                'reporte_id' => null
            ]);
            return redirect()->route('vehiculos.index')->with('success', 'Vehículo asignado correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se encontró el detalle del vehículo para asignar.');
        }
    }

    public function asignarVehiculoSeleccionado($detalleId)
    {
        $this->authorizeCoordinadorAdmin();
        $tipos = TipoVehiculo::all();
        $detalle = DetalleVehiculo::with('vehiculo')->findOrFail($detalleId);
        $personas = Persona::all();
        return view('modulos.vehiculos.actions.asignar', compact('tipos', 'detalle', 'personas'));
    }

    public function devolver(Request $request)
    {
        $this->authorizeCoordinadorAdmin();
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
        ]);
        $detalle = DetalleVehiculo::where('id_vehiculo', $request->vehiculo_id)
            ->where('id_estadoregistro', 1)
            ->first();
        if ($detalle) {
            $detalle->persona_id = null;
            $estadoDisponible = Estado::where('estado', 'disponible')->first();
            if ($estadoDisponible) {
                $detalle->id_estado = $estadoDisponible->id;
            }
            $detalle->save();
            \App\Models\HistorialVehiculo::create([
                'vehiculo_id' => $detalle->vehiculo->id,
                'tipo_evento' => 'devolucion',
                'fecha' => now(),
                'descripcion' => 'Vehículo devuelto y puesto disponible',
                'usuario_id' => auth()->id(),
                'reporte_id' => null
            ]);
            return redirect()->route('vehiculos.index')->with('success', 'Vehículo devuelto correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se encontró el detalle del vehículo para devolver.');
        }
    }
}