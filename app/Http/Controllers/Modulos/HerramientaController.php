<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Herramienta;
use App\Models\TipoHerramienta;
use App\Models\Estado;

class HerramientaController extends Controller
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
        $herramientas = Herramienta::all();
        return view('modulos.herramientas.index', compact('herramientas'));
    }

    public function mecanicas()
    {
        $mecanicas = Herramienta::with('tipoHerramienta')
                        ->where('id_tipoherramienta', 1)
                        ->get();
        return view('modulos.herramientas.tipos.mecanicas', compact('mecanicas'));
    }

    public function electricas()
    {
        $electricas = Herramienta::with('tipoHerramienta')
                        ->where('id_tipoherramienta', 2)
                        ->get();
        return view('modulos.herramientas.tipos.electricas', compact('electricas'));
    }

    public function medicion()
    {
        $medicion = Herramienta::with('tipoHerramienta')
                        ->where('id_tipoherramienta', 3)
                        ->get();
        return view('modulos.herramientas.tipos.medicion', compact('medicion'));
    }

    public function otros()
    {
        $otros = Herramienta::with('tipoHerramienta')
                        ->where('id_tipoherramienta', 4)
                        ->get();
        return view('modulos.herramientas.tipos.otros', compact('otros'));
    }

    public function create()
    {
        $this->authorizeCoordinadorAdmin();
        $tipos = TipoHerramienta::all();
        $estados = Estado::all();
        return view('modulos.herramientas.agregar', compact('tipos', 'estados'));
    }

    public function store(Request $request)
    {
        $this->authorizeCoordinadorAdmin();
        if ($request->has('id_tipoherramienta') && !$request->has('tipo_herramienta_id')) {
            $request->merge(['tipo_herramienta_id' => $request->input('id_tipoherramienta')]);
        }
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_herramienta_id' => 'required|integer',
            'id_estado' => 'nullable|integer',
            'id_estadoregistro' => 'nullable|integer',
            'descripcion' => 'nullable|string',
        ]);
        Herramienta::create($request->all());
        return redirect()->route('herramientas.index')->with('success', 'Herramienta agregada correctamente.');
    }

    public function edit($id)
    {
        $this->authorizeCoordinadorAdmin();
        $herramienta = Herramienta::findOrFail($id);
        $tipos = TipoHerramienta::all();
        $estados = Estado::all();
        return view('modulos.herramientas.edit', compact('herramienta', 'tipos', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeCoordinadorAdmin();
        if ($request->has('id_tipoherramienta') && !$request->has('tipo_herramienta_id')) {
            $request->merge(['tipo_herramienta_id' => $request->input('id_tipoherramienta')]);
        }
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_herramienta_id' => 'required|integer',
            'descripcion' => 'nullable|string',
        ]);
        $herramienta = Herramienta::findOrFail($id);
        $herramienta->update($request->all());
        return redirect()->route('herramientas.index')->with('success', 'Herramienta actualizada correctamente.');
    }

    public function eliminate()
    {
        $this->authorizeCoordinadorAdmin();
        $herramientas = Herramienta::where('id_estadoregistro', '!=', 2)->get();
        return view('modulos.herramientas.eliminar', compact('herramientas'));
    }

    public function destroy($id)
    {
        $this->authorizeCoordinadorAdmin();
        try {
            $herramienta = Herramienta::findOrFail($id);
            $herramienta->delete();
            return redirect()->route('herramientas.eliminate')->with('success', 'Herramienta eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('herramientas.eliminate')->with('error', 'Error al eliminar la herramienta.');
        }
    }

    public function asignarForm($herramientaId = null)
    {
        $this->authorizeCoordinadorAdmin();
        $herramientas = Herramienta::whereNull('persona_id')->get();

        if ($herramientaId) {
            $herramientaSeleccionada = Herramienta::find($herramientaId);
        }

        $personas = \App\Models\Persona::whereHas('user.roles', function ($query) {
            $query->where('rol', 'Mecánico');
        })->get();

        return view('modulos.herramientas.asignar', compact('herramientas', 'personas', 'herramientaSeleccionada'));
    }

    public function asignar(Request $request)
    {
        $this->authorizeCoordinadorAdmin();
        try {
            $validated = $request->validate([
                'herramienta_id' => 'required|exists:herramientas,id',
                'persona_id' => 'required|exists:personas,id',
            ]);

            \Log::info('Asignar herramienta - Datos validados:', $validated);

            $herramienta = Herramienta::findOrFail($request->herramienta_id);
            \Log::info('Herramienta antes:', $herramienta->toArray());

            $herramienta->update(['persona_id' => $request->persona_id]);
            $herramienta->touch();
            
            \Log::info('Herramienta después:', $herramienta->fresh()->toArray());

            return redirect()->route('herramientas.index')->with('success', 'Herramienta asignada correctamente a persona ID: ' . $request->persona_id);
        } catch (\Exception $e) {
            \Log::error('Error al asignar herramienta:', ['error' => $e->getMessage()]);
            return redirect()->route('herramientas.index')->with('error', 'Error al asignar: ' . $e->getMessage());
        }
    }

    public function devolver(Herramienta $herramienta)
    {
        $this->authorizeCoordinadorAdmin();
        try {
            \Log::info('Devolver herramienta - Antes:', ['persona_id' => $herramienta->persona_id]);
            
            $herramienta->update(['persona_id' => null]);
            $herramienta->touch();
            
            \Log::info('Devolver herramienta - Después:', ['persona_id' => $herramienta->fresh()->persona_id]);
            
            return redirect()->route('herramientas.index')->with('success', 'Herramienta devuelta correctamente.');
        } catch (\Exception $e) {
            \Log::error('Error al devolver herramienta:', ['error' => $e->getMessage()]);
            return redirect()->route('herramientas.index')->with('error', 'Error al devolver: ' . $e->getMessage());
        }
    }
}