<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\User;

class AsignarRolMecanicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el rol de Mecánico
        $rolMecanico = Rol::where('rol', 'Mecánico')->first();

        if (!$rolMecanico) {
            $this->command->info('Rol Mecánico no encontrado. Por favor ejecuta RolSeeder primero.');
            return;
        }

        // Obtener las 4 personas creadas en PersonasMecanicosSeeder
        $personas = Persona::whereIn('num_documento', [
            '1234567890',
            '1234567891',
            '1234567892',
            '1234567893',
        ])->get();

        // Para cada persona, crear un usuario y asignar el rol de Mecánico
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

            // Asignar el rol de Mecánico si no lo tiene ya
            if (!$user->roles->contains('id', $rolMecanico->id)) {
                $user->roles()->attach($rolMecanico->id);
            }
        }

        $this->command->info('Rol Mecánico asignado a las personas correctamente.');
    }
}
