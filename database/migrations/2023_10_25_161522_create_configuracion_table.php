<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id();
            $table->string('ruta_foto_principal');
            $table->string('slogan');
            $table->string('ruta_video');
            $table->string('celular_principal');
            $table->string('celular_secundario');
            $table->string('correo_principal');
            $table->string('correo_secundario');
            $table->string('horario_atencion_principal');
            $table->string('link_facebook');
            $table->string('link_instagram');
            $table->string('link_youtube');
            $table->string('link_linkedln');
            $table->string('razon_social');
            $table->string('nombre');
            $table->string('ruta_foto_header_seccion');
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
        Schema::dropIfExists('configuracion');
    }
}
