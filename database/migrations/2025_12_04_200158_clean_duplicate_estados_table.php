<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Delete duplicate estados, keep only the first 4 (Disponible, Prestado, Fuera de servicio, Inactivo)
        DB::statement('DELETE FROM estados WHERE id > 4');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore would need to re-seed, but that's ok for now
    }
};
