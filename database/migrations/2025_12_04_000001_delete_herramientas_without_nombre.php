<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Eliminar herramientas sin nombre (registros previos problemáticos)
        DB::table('herramientas')->whereNull('nombre')->orWhere('nombre', '')->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No hay nada que deshacer en este caso
    }
};
