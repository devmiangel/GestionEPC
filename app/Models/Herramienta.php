<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    use HasFactory;

    protected $table = 'herramientas';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'id_tipoherramienta',
        // alias usado por vistas/controladores (mantener compatibilidad)
        'tipo_herramienta_id',
        'id_estado',
        'id_estadoregistro',
        'especificacion_herramienta',
        'descripcion',
        'persona_id',
    ];

    public function tipoHerramienta()
    {
        return $this->belongsTo(TipoHerramienta::class, 'id_tipoherramienta');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }

    public function estadoRegistro()
    {
        return $this->belongsTo(EstadoRegistro::class, 'id_estadoregistro');
    }

    public function prestamos()
    {
        return $this->hasMany(PrestamoHerramienta::class, 'id_herramienta');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    // Accessor / Mutator to provide compatibility with views/controllers
    // that use `tipo_herramienta_id` instead of the DB column `id_tipoherramienta`.
    public function getTipoHerramientaIdAttribute()
    {
        return $this->attributes['id_tipoherramienta'] ?? null;
    }

    public function setTipoHerramientaIdAttribute($value)
    {
        $this->attributes['id_tipoherramienta'] = $value;
    }
}
