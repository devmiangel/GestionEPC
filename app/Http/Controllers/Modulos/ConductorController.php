<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;

class ConductorController extends Controller
{
    public function index()
    {
        $conductores = Persona::all();
        return view('modulos.conductores.index', compact('conductores'));
    }

    public function create()
    {
        return view('modulos.conductores.agregar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'licencia' => 'required|string|max:255',
            'vencimiento_licencia' => 'required|date',
        ]);
        Persona::create($request->all());
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
        $conductor->delete();
        return redirect()->route('conductores.index')->with('success', 'Conductor eliminado correctamente.');
    }

    public function edit($id)
    {
        $conductor = Persona::findOrFail($id);
        return view('modulos.conductores.editar', compact('conductor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'licencia' => 'required|string|max:255',
            'vencimiento_licencia' => 'required|date',
        ]);
        $conductor = Persona::findOrFail($id);
        $conductor->update($request->all());
        return redirect()->route('conductores.index')->with('success', 'Conductor actualizado correctamente.');
    }
}
