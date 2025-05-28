<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;
use App\Models\User;
use App\Models\Persona;
use App\Models\Vehiculo;

class PruebaAlertasSeeder extends Seeder
{
    public function run()
    {
        // 1. Crear roles
        $adminRol = Rol::firstOrCreate(['rol' => 'Administrador']);
        $coordRol = Rol::firstOrCreate(['rol' => 'Coordinador']);

        // 2. Crear personas responsables
        $personaAdmin = Persona::firstOrCreate([
            'primer_nombre' => 'Admin',
            'primer_apellido' => 'Prueba',
            'num_documento' => '123345678',
            'id_tipdocumento' => '1'

        ]);
        $personaCoord = Persona::firstOrCreate([
            'primer_nombre' => 'Coord',
            'primer_apellido' => 'Prueba',
            'num_documento' => '1233456789',
            'id_tipdocumento' => '1'
        ]);

        // 3. Crear usuarios y asociar roles y personas
        $userAdmin = User::firstOrCreate([
            'email' => 'admin@prueba.com',
        ], [
            'password' => Hash::make('password'),
            'id_persona' => $personaAdmin->id,
        ]);
        $userCoord = User::firstOrCreate([
            'email' => 'coord@prueba.com',
        ], [
            'password' => Hash::make('password'),
            'id_persona' => $personaCoord->id,
        ]);

        // Asignar roles usando la tabla intermedia
        if (method_exists($userAdmin, 'roles')) {
            $userAdmin->roles()->sync([$adminRol->id]);
        }
        if (method_exists($userCoord, 'roles')) {
            $userCoord->roles()->sync([$coordRol->id]);
        }

        // 4. Crear vehículos con fechas próximas a vencer y responsables
        $tipoVehiculoId = 1; // Ajusta según tu seeder de tipo_vehiculos
        $vehiculo1 = Vehiculo::create([
            'modelo_vehiculo' => '2020',
            'marca_vehiculo' => 'Toyota',
            'id_tipovehiculo' => $tipoVehiculoId,
        ]);
        $vehiculo2 = Vehiculo::create([
            'modelo_vehiculo' => '2021',
            'marca_vehiculo' => 'Mazda',
            'id_tipovehiculo' => $tipoVehiculoId,
        ]);

        

        // Crear detalles de vehículos con fechas próximas a vencer y responsables
        DB::table('detalle_vehiculos')->insert([
            [
                'id_vehiculo' => $vehiculo1->id,
                'persona_id' => $userAdmin->id,
                'id_estado' => 1, // Ajusta según tu seeder de estados
                'id_estadoregistro' => 1, // Ajusta según tu seeder de estado_registros
                'placa' => 'AAA111',
                'Nombre' => 'Vehículo Admin',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(2),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(5),
                'fecha_tecnomecanica' => now()->addDays(10),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(6),
                'descripcion_ultimo_mantenimiento' => 'Cambio de aceite',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_vehiculo' => $vehiculo2->id,
                'persona_id' => $userCoord->id,
                'id_estado' => 1,
                'id_estadoregistro' => 1,
                'placa' => 'BBB222',
                'Nombre' => 'Vehículo Coord',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(3),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(7),
                'fecha_tecnomecanica' => now()->addDays(14),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(5),
                'descripcion_ultimo_mantenimiento' => 'Revisión general',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 5. Crear mantenimientos de prueba para los detalles de vehículos
        $tipoMantId = DB::table('tipo_mantenimientos')->insertGetId([
            'mantenimiento' => 'General',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $detalleVehiculos = DB::table('detalle_vehiculos')->get();
        foreach ($detalleVehiculos as $detalle) {
            DB::table('mantenimientos')->insert([
                [
                    'id_detallevehiculo' => $detalle->id,
                    'fecha_mantenimiento' => now()->subMonths(6),
                    'id_tipomantenimiento' => $tipoMantId,
                    'detalles_mantenimiento' => 'Cambio de aceite',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_detallevehiculo' => $detalle->id,
                    'fecha_mantenimiento' => now()->subMonths(3),
                    'id_tipomantenimiento' => $tipoMantId,
                    'detalles_mantenimiento' => 'Revisión general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
