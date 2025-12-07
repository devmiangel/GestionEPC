<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoHerramientasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_herramientas')->insert([
            ['tipo_herramienta' => 'Mecánica', 'cantidad' => 0],
            ['tipo_herramienta' => 'Eléctrica', 'cantidad' => 0],
            ['tipo_herramienta' => 'Medición', 'cantidad' => 0],
            ['tipo_herramienta' => 'Otros', 'cantidad' => 0],
        ]);
    }
}
