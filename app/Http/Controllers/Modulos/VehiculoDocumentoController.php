<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\DetalleVehiculo;
use Illuminate\Support\Facades\Storage;
use App\Models\VehiculoDocumento;

class VehiculoDocumentoController extends Controller
{
    public function subir(Request $request, $detalle)
    {
        $request->validate([
            'documento' => 'required|file|mimes:pdf,jpg,png|max:20480',
            'nombre' => 'required|string|max:255',
            'fecha' => 'required|date',
        ]);

        $detalleVehiculo = DetalleVehiculo::findOrFail($detalle);

        $path = $request->file('documento')->store('vehiculos/documentos', 'public');

        $doc = new VehiculoDocumento();
        $doc->id_detallevehiculo = $detalleVehiculo->id;
        $doc->nombre = $request->nombre;
        $doc->fecha = $request->fecha;
        $doc->ruta = $path;
        $doc->save();

        return back()->with('success', 'Documento subido correctamente.');
    }

    public function descargar($documento)
    {
        $doc = VehiculoDocumento::findOrFail($documento);
        return Storage::disk('public')->download($doc->ruta, ($doc->nombre ?: 'documento') . '.pdf', [
            'Content-Type' => 'application/pdf'
        ]);
    }

    public function historial($detalle)
    {
        $detalleVehiculo = DetalleVehiculo::with('documentos')->findOrFail($detalle);
        return view('modulos.vehiculos.actions.historial', compact('detalleVehiculo'));
    }

    public function ver($documento)
    {
        $doc = VehiculoDocumento::findOrFail($documento);
        $filename = preg_replace('/\s+/', '_', $doc->nombre ?: 'documento') . '.pdf';
        return response()->file(storage_path('app/public/' . $doc->ruta), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    public function eliminar($id)
    {
        $documento = vehiculoDocumento::findOrFail(id: $id);

        if ($documento->ruta && \Storage::disk('public')->exists($documento->ruta)) {
            \Storage::disk('public')->delete($documento->ruta);
        }

        $documento->delete();

        return back()->with('success', 'Documento eliminado correctamente.');
    }
}

