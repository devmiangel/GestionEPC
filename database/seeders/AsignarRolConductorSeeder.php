<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\User;

class AsignarRolConductorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el rol de Conductor
        $rolConductor = Rol::where('rol', 'Conductor')->first();

        if (!$rolConductor) {
            $this->command->info('Rol Conductor no encontrado. Por favor ejecuta RolSeeder primero.');
            return;
        }

        // Obtener las personas creadas en PersonasConductoresSeeder
        $personas = Persona::whereIn('num_documento', [
            '2234567890',
            '2234567891',
            '2234567892',
            '2234567893',
        ])->get();

        foreach ($personas as $persona) {
            // Verificar si ya existe un usuario para esta persona
            $user = User::where('id_persona', $persona->id)->first();

            if (!$user) {
                // Crear usuario si no existe
                $user = User::create([
                    'email' => strtolower($persona->primer_nombre . '.' . $persona->primer_apellido) . '@epc.local',
                    'password' => bcrypt('password123'),
                    'id_persona' => $persona->id,
                ]);
            }

            // Asignar el rol de Conductor si no lo tiene ya
            if (!$user->roles->contains('id', $rolConductor->id)) {
                $user->roles()->attach($rolConductor->id);
            }
        }

        $this->command->info('Rol Conductor asignado a las personas correctamente.');
    }
}
