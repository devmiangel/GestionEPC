<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasConductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personas')->insert([
            [
                'primer_nombre' => 'Carlos',
                'segundo_nombre' => 'Miguel',
                'primer_apellido' => 'Vargas',
                'segundo_apellido' => 'Ríos',
                'num_documento' => '2234567890',
                'id_tipdocumento' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primer_nombre' => 'Lucía',
                'segundo_nombre' => 'Mariana',
                'primer_apellido' => 'Hernández',
                'segundo_apellido' => 'Suárez',
                'num_documento' => '2234567891',
                'id_tipdocumento' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primer_nombre' => 'Andrés',
                'segundo_nombre' => 'Diego',
                'primer_apellido' => 'Torres',
                'segundo_apellido' => 'Molina',
                'num_documento' => '2234567892',
                'id_tipdocumento' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primer_nombre' => 'Sofía',
                'segundo_nombre' => 'Valeria',
                'primer_apellido' => 'Castillo',
                'segundo_apellido' => 'Navarro',
                'num_documento' => '2234567893',
                'id_tipdocumento' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
