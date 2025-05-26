<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Funcion;

class FuncionSeeder extends Seeder
{
    public function run(): void
    {
        Funcion::create(['funcion' => 'ver_dashboard_admin', 'descripcion' => 'Ver panel de administrador']);
        Funcion::create(['funcion' => 'editar_usuarios', 'descripcion' => 'Editar información de usuarios']);
    }
}

