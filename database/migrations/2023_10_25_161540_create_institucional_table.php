<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitucionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institucional', function (Blueprint $table) {
            $table->id();
            $table->string('slogan_home',70);
            $table->string('breve_historia');
            $table->string('mision');
            $table->string('vision');
            $table->string('ruta_foto_principal');
            $table->string('ruta_foto_secundaria');
            $table->date('fecha_inicio')->nullable();
            $table->enum('estado', [0, 1])->default(1); // '0' Inactivo, '1' Activo 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institucional');
    }
}
