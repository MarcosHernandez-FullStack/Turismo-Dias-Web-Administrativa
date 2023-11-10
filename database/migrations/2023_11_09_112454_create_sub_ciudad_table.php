<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCiudadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_ciudad', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
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
        Schema::dropIfExists('sub_ciudad');
    }
}
