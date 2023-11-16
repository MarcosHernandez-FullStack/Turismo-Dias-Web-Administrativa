<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminoCondicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termino_condicion', function (Blueprint $table) {
            $table->id();
            $table->string('seccion',120);
            $table->text('descripcion',255);
            $table->bigInteger('orden')->nullable();
            $table->enum('estado', [0, 1])->default(1);
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
        Schema::dropIfExists('termino_condicion');
    }
}
