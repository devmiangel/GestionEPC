<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;

class ConductorController extends Controller
{
    public function index()
    {
        $conductores = Persona::whereHas('user.roles', function ($q) {
            $q->where('rols.rol', 'Conductor');
        })
        ->with(['tipoDocumento'])
        ->get();
        
        return view('modulos.conductores.index', compact('conductores'));
    }

    public function create()
    {
        $tipos_documento = \App\Models\TipoDocumento::all();
        return view('modulos.conductores.actions.agregar', compact('tipos_documento'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'num_documento' => 'required|string|max:255|unique:personas,num_documento',
            'id_tipdocumento' => 'required|exists:tipo_documentos,id',
        ]);

        $data = $request->only([
            'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'num_documento', 'id_tipdocumento'
        ]);

        $persona = Persona::create($data);

        try {
            $userData = [
                'email' => strtolower($persona->primer_nombre . '.' . $persona->primer_apellido) . '.' . $persona->num_documento . '@epc.local',
                'password' => bcrypt('password123'),
                'id_persona' => $persona->id,
            ];

            $existing = \App\Models\User::where('email', $userData['email'])->first();
            if ($existing) {
                $userData['email'] = strtolower($persona->primer_nombre . '.' . $persona->primer_apellido) . '.' . $persona->id . '@epc.local';
            }

            $user = \App\Models\User::create($userData);

            $rolConductor = \App\Models\Rol::where('rol', 'Conductor')->first();
            if ($rolConductor) {
                $user->roles()->attach($rolConductor->id);
            }
        } catch (\Exception $e) {
            logger()->error('Error creando usuario para conductor: ' . $e->getMessage());
        }

        return redirect()->route('conductores.index')->with('success', 'Conductor agregado correctamente.');
    }

    public function eliminate()
    {
        $conductores = Persona::all();
        return view('modulos.conductores.eliminar', compact('conductores'));
    }

    public function destroy($id)
    {
        $conductor = Persona::findOrFail($id);

        if ($conductor->user) {
            try {
                $user = $conductor->user;
                if (method_exists($user, 'roles')) {
                    $user->roles()->detach();
                }
                $user->delete();
            } catch (\Exception $e) {
                logger()->error('Error al eliminar usuario asociado al conductor: ' . $e->getMessage());
            }
        }

        $conductor->delete();
        return redirect()->route('conductores.index')->with('success', 'Conductor eliminado correctamente.');
    }

    public function edit($id)
    {
        $conductor = \App\Models\Persona::findOrFail($id);
        $tipos_documento = \App\Models\TipoDocumento::all();
        return view('modulos.conductores.actions.modificar', compact('conductor', 'tipos_documento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'num_documento' => 'required|string|max:255|unique:personas,num_documento,' . $id,
            'id_tipdocumento' => 'required|exists:tipo_documentos,id',
        ]);
        $conductor = Persona::findOrFail($id);
        $data = $request->only([
            'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'num_documento', 'id_tipdocumento'
        ]);
        $conductor->update($data);
        return redirect()->route('conductores.index')->with('success', 'Conductor actualizado correctamente.');
    }

    public function asignarForm()
    {
        $vehiculos = \App\Models\Vehiculo::all();
        $conductores = Persona::all();
        return view('modulos.conductores.asignar', compact('vehiculos', 'conductores'));
    }

    public function asignar(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'conductor_id' => 'required|exists:personas,id',
        ]);
        $vehiculo = \App\Models\Vehiculo::findOrFail($request->vehiculo_id);
        $vehiculo->conductor_id = $request->conductor_id;
        $vehiculo->save();
        return redirect()->route('conductores.index')->with('success', 'Conductor asignado correctamente al vehículo.');
    }
}