<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([
            ['estado' => 'disponible'],
            ['estado' => 'no disponible'],
            ['estado' => 'en mantenimiento'],
            ['estado' => 'en prestamo'],
        ]);
    }
}