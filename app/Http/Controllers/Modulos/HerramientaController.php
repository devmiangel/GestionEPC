<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Herramienta;

class HerramientaController extends Controller
{
    public function index()
    {
        // Aquí podrías obtener datos desde base de datos si deseas.
        return view('modulos.herramientas.index');
    }

    public function create()
    {
        return view('modulos.herramientas.agregar');
    }

    public function eliminate()
    {
        return view('modulos.herramientas.eliminar');
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

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_herramienta_id' => 'required|integer',
            'descripcion' => 'nullable|string',
        ]);
        Herramienta::create($request->all());
        return redirect()->route('herramientas.index')->with('success', 'Herramienta agregada correctamente.');
    }
}
