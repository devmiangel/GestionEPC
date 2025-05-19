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
        Schema::create('tipo_documentos', function (Blueprint $table) {
            $table->id();

            $table->string('tipo_documento');

            $table->timestamps();
        });

        DB::table('tipo_documentos')->insert([
            ['tipo_documento' => 'Cédula de Ciudadanía'],
            ['tipo_documento' => 'Cédula de Extranjería'],
            ['tipo_documento' => 'Pasaporte'],
            ['tipo_documento' => 'NIT'],
            ['tipo_documento' => 'Otro'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_documentos');
    }
};
