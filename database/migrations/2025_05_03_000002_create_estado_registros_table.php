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
        Schema::create('estado_registros', function (Blueprint $table) {
            $table->id();

            $table->string('estado_registro', 255);

            $table->timestamps();
        });

        DB::table('estado_registros')->insert([
            ['estado_registro' => 'Activo'],
            ['estado_registro' => 'Oculto'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_registros');
    }
};
