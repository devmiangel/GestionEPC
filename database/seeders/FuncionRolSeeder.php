<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Funcion;

class FuncionRolSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Rol::where('rol', 'Administrador')->first();
        $usuario = Rol::where('rol', 'Usuario')->first();

        $funciones = Funcion::pluck('id', 'funcion');

        // Asignar funciones al rol administrador
        $admin->funciones()->sync([
            $funciones['ver_dashboard_admin'],
            $funciones['editar_usuarios'],
        ]);

        // Asignar solo una función al rol usuario
        $usuario->funciones()->sync([
            $funciones['ver_dashboard_admin'],
        ]);
    }
}
