<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AlertasController extends Controller
{
    /**
     * Envía alertas por correo a los responsables de vehículos con documentos próximos a vencer.
     */
    public function enviarAlertas()
    {
        $hoy = Carbon::now();
        $diasAlerta = 15; // Días antes del vencimiento para alertar

        // Buscar vehículos con SOAT, técnico-mecánica o mantenimiento próximos a vencer
        $vehiculos = Vehiculo::where(function($query) use ($hoy, $diasAlerta) {
            $query->whereDate('fecha_vencimiento_soat', '<=', $hoy->copy()->addDays($diasAlerta))
                  ->whereDate('fecha_vencimiento_soat', '>=', $hoy)
                ->orWhere(function($q) use ($hoy, $diasAlerta) {
                    $q->whereDate('fecha_vencimiento_tecnomecanica', '<=', $hoy->copy()->addDays($diasAlerta))
                      ->whereDate('fecha_vencimiento_tecnomecanica', '>=', $hoy);
                })
                ->orWhere(function($q) use ($hoy, $diasAlerta) {
                    $q->whereDate('fecha_proximo_mantenimiento', '<=', $hoy->copy()->addDays($diasAlerta))
                      ->whereDate('fecha_proximo_mantenimiento', '>=', $hoy);
                });
        })->get();

        foreach ($vehiculos as $vehiculo) {
            // Suponiendo que el vehículo tiene un responsable relacionado
            $responsable = $vehiculo->responsable; // Ajusta según tu relación
            // Solo enviar a responsables que sean coordinadores o administradores
            if ($responsable && $responsable->email && in_array($responsable->rol->nombre ?? '', ['Coordinador', 'Administrador'])) {
                $alertas = [];
                if ($vehiculo->fecha_vencimiento_soat && $vehiculo->fecha_vencimiento_soat <= $hoy->copy()->addDays($diasAlerta)) {
                    $alertas[] = 'SOAT vence el ' . $vehiculo->fecha_vencimiento_soat;
                }
                if ($vehiculo->fecha_vencimiento_tecnomecanica && $vehiculo->fecha_vencimiento_tecnomecanica <= $hoy->copy()->addDays($diasAlerta)) {
                    $alertas[] = 'Revisión técnico-mecánica vence el ' . $vehiculo->fecha_vencimiento_tecnomecanica;
                }
                if ($vehiculo->fecha_proximo_mantenimiento && $vehiculo->fecha_proximo_mantenimiento <= $hoy->copy()->addDays($diasAlerta)) {
                    $alertas[] = 'Mantenimiento preventivo programado para el ' . $vehiculo->fecha_proximo_mantenimiento;
                }
                if (count($alertas)) {
                    Mail::raw(
                        "Atención: El vehículo {$vehiculo->placa} tiene documentos próximos a vencer:\n" . implode("\n", $alertas),
                        function ($message) use ($responsable, $vehiculo) {
                            $message->to($responsable->email)
                                    ->subject('Alerta de vencimiento de documentos de vehículo');
                        }
                    );
                }
            }
        }
        return response()->json(['message' => 'Alertas enviadas.']);
    }

    /**
     * Muestra la lista de alertas del usuario autenticado.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        // Suponiendo que existe la relación alertas en el modelo User
        $alertas = $user->alertas()->latest()->paginate(10);
        return view('modulos.alertas.index', compact('alertas'));
    }
}
