<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_estadoregistro');
            $table->rememberToken();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_persona')
                  ->references('id')
                  ->on('personas')
                  ->onDelete('cascade');

            $table->foreign('id_estadoregistro')
                  ->references('id')
                  ->on('estado_registros')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
