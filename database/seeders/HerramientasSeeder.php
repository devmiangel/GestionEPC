<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HerramientasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserciones de ejemplo para pruebas locales (sin truncate para evitar FK constraints)
        DB::table('herramientas')->insert([
            [
                'nombre' => 'Llave inglesa 12"',
                'id_tipoherramienta' => 1,
                'id_estado' => 1,
                'id_estadoregistro' => 1,
                'especificacion_herramienta' => 'Acero al carbono, 12 pulgadas',
                'descripcion' => 'Llave ajustable para tuercas y tornillos',
                'persona_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Taladro inalámbrico',
                'id_tipoherramienta' => 2,
                'id_estado' => 1,
                'id_estadoregistro' => 1,
                'especificacion_herramienta' => '18V, batería incluida',
                'descripcion' => 'Taladro para perforaciones ligeras',
                'persona_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Multímetro digital',
                'id_tipoherramienta' => 3,
                'id_estado' => 1,
                'id_estadoregistro' => 1,
                'especificacion_herramienta' => 'Medición de voltaje, corriente y resistencia',
                'descripcion' => 'Para mediciones eléctricas',
                'persona_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cinta métrica 5m',
                'id_tipoherramienta' => 4,
                'id_estado' => 1,
                'id_estadoregistro' => 1,
                'especificacion_herramienta' => '5 metros, carcasa plástica',
                'descripcion' => 'Cinta para mediciones rápidas',
                'persona_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
