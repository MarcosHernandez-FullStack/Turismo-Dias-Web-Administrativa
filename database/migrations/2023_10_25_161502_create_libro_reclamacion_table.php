<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroReclamacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libro_reclamacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo_consumidor');
            $table->string('direccion_consumidor');
            $table->string('email_consumidor');
            $table->string('nombre_completo_apoderado_consumidor');
            $table->string('documento_identidad_consumidor');
            $table->string('telefono_consumidor');
            $table->enum('tipo_bien', [1, 2]); // '1' Servicio, '2' Producto
            $table->string('descripcion_bien');
            $table->string('monto_reclamado_bien');
            $table->enum('tipo_reclamacion_detalle', [1, 2]); // '1' Reclamo, '2' Queja
            $table->string('descripcion_reclamacion_detalle');
            $table->string('pedido_reclamacion_detalle');
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
        Schema::dropIfExists('libro_reclamacion');
    }
}
