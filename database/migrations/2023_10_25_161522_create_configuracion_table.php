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
            $table->string('ruta_foto_principal')->nullable();
            $table->string('slogan')->nullable();
            $table->string('ruta_video')->nullable();
            $table->string('celular_principal')->nullable();
            $table->string('celular_secundario')->nullable();
            $table->string('correo_principal')->nullable();
            $table->string('correo_secundario')->nullable();
            $table->string('horario_atencion_principal')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_youtube')->nullable();
            $table->string('link_linkedln')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('nombre')->nullable();
            $table->string('subtitulo_servicio')->nullable();
            $table->string('subtitulo_ruta')->nullable();
            $table->string('subtitulo_libro_reclamacion')->nullable();
            $table->string('subtitulo_evento')->nullable();
            $table->string('subtitulo_termino_condicion')->nullable();
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
