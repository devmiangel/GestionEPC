<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasMecanicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personas')->insert([
            [
                'primer_nombre' => 'Juan',
                'segundo_nombre' => 'Carlos',
                'primer_apellido' => 'García',
                'segundo_apellido' => 'López',
                'num_documento' => '1234567890',
                'id_tipdocumento' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primer_nombre' => 'María',
                'segundo_nombre' => 'José',
                'primer_apellido' => 'Rodríguez',
                'segundo_apellido' => 'Pérez',
                'num_documento' => '1234567891',
                'id_tipdocumento' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primer_nombre' => 'Pedro',
                'segundo_nombre' => 'Antonio',
                'primer_apellido' => 'Martínez',
                'segundo_apellido' => 'García',
                'num_documento' => '1234567892',
                'id_tipdocumento' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'primer_nombre' => 'Ana',
                'segundo_nombre' => 'Isabel',
                'primer_apellido' => 'Sánchez',
                'segundo_apellido' => 'Torres',
                'num_documento' => '1234567893',
                'id_tipdocumento' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
