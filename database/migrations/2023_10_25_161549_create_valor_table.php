<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',30);
            $table->enum('estado', [0, 1])->default(1); // '0' Inactivo, '1' Activo 
            $table->foreignId('institucional_id')->constrained('institucional');
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
        Schema::dropIfExists('valor');
    }
}
