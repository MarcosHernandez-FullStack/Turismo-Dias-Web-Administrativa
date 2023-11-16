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
<<<<<<< HEAD
            $table->text('descripcion',255);
=======
            $table->string('descripcion');
>>>>>>> 367f02f95879b8e97f1724f3bf6f3bc8666409b3
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
