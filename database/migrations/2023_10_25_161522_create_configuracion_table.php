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
            $table->string('ruta_logo')->nullable();
            $table->string('slogan', 80)->nullable();
            $table->string('ruta_video')->nullable();
            $table->string('celular_principal', 20)->nullable();
            $table->string('celular_secundario', 20)->nullable();
            $table->string('correo_principal', 30)->nullable();
            $table->string('correo_secundario', 30)->nullable();
            $table->string('horario_atencion_principal', 30)->nullable();
            $table->string('link_facebook', 50)->nullable();
            $table->string('link_instagram', 50)->nullable();
            $table->string('link_youtube', 50)->nullable();
            $table->string('link_twitter', 50)->nullable();
            $table->string('link_linkedln', 50)->nullable();
            $table->string('razon_social', 50)->nullable();
            $table->string('nombre', 50)->nullable();
            $table->string('subtitulo_servicio', 130)->nullable();
            $table->string('subtitulo_ruta', 130)->nullable();
            $table->text('subtitulo_libro_reclamacion')->nullable();
            $table->string('subtitulo_evento', 130)->nullable();
            $table->string('subtitulo_termino_condicion', 130)->nullable();
            $table->string('ruta_foto_header_seccion')->nullable();
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
