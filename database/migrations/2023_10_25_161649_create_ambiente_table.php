<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambiente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('tipo', [1, 2, 3]); // '1' oficina, '2' terrapuerto, '3' almacen
            $table->decimal('coordenada_longitud', $precision = 16, $scale = 10);
            $table->decimal('coordenada_latitud', $precision = 16, $scale = 10);
            $table->string('direccion');
            $table->string('horario_atencion');
            $table->string('telefono');
            $table->foreignId('ciudad_id')->constrained('ciudad');
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
        Schema::dropIfExists('ambiente');
    }
}
