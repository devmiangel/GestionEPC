<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';

    public $timestamps = true;

    protected $fillable = [
        'id_detallevehiculo',
        'id_tiporeporte',
        'fecha_reporte',
    ];

    public function detalleVehiculo()
    {
        return $this->belongsTo(DetalleVehiculo::class, 'id_detallevehiculo');
    }

    public function tipoReporte()
    {
        return $this->belongsTo(TipoReporte::class, 'id_tiporeporte');
    }
}
