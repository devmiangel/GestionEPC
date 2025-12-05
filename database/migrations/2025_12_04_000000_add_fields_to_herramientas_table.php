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
        Schema::table('herramientas', function (Blueprint $table) {
            // Agregar campos faltantes según el modelo y vistas
            if (!Schema::hasColumn('herramientas', 'nombre')) {
                $table->string('nombre', 255)->nullable()->after('id');
            }
            if (!Schema::hasColumn('herramientas', 'descripcion')) {
                $table->text('descripcion')->nullable()->after('especificacion_herramienta');
            }
            if (!Schema::hasColumn('herramientas', 'persona_id')) {
                $table->unsignedBigInteger('persona_id')->nullable()->after('descripcion');
                $table->foreign('persona_id')->references('id')->on('personas')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('herramientas', function (Blueprint $table) {
            if (Schema::hasColumn('herramientas', 'persona_id')) {
                $table->dropForeign(['persona_id']);
                $table->dropColumn('persona_id');
            }
            if (Schema::hasColumn('herramientas', 'descripcion')) {
                $table->dropColumn('descripcion');
            }
            if (Schema::hasColumn('herramientas', 'nombre')) {
                $table->dropColumn('nombre');
            }
        });
    }
};
