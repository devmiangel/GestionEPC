<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVehiculo extends Model
{
    use HasFactory;

    protected $table = 'detalle_vehiculos';

    public $timestamps = true;

    protected $fillable = [
        'id_vehiculo',
        'persona_id',
        'id_estado',
        'id_estadoregistro',
        'placa',
        'conductor_auxiliar',
        'fecha_solicitud',
        'fecha_devolucion',
        'fecha_soat',
        'fecha_tecnomecanica',
        'imagen_vehiculo',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo');
    }

    public function persona()
    {
        return $this->belongsTo(User::class, 'persona_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }

    public function estadoRegistro()
    {
        return $this->belongsTo(EstadoRegistro::class, 'id_estadoregistro');
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'id_detallevehiculo');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_detallevehiculo');
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'id_detallevehiculo');
    }
}
