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
        $coordinador = Rol::where('rol', 'Coordinador')->first();
        $usuario = Rol::where('rol', 'Usuario')->first();

        $funciones = Funcion::pluck('id', 'funcion');

        $admin->funciones()->sync([
            $funciones['ver_dashboard_admin'],
            $funciones['editar_usuarios'],
        ]);

        $coordinador->funciones()->sync([
            $funciones['ver_dashboard_admin'],
            $funciones['editar_usuarios'],
        ]);

        $usuario->funciones()->sync([
            $funciones['ver_dashboard_admin'],
        ]);
    }
}
