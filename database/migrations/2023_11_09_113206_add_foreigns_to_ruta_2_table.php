<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignsToRuta2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ruta', function (Blueprint $table) {
            $table->foreignId('sub_ciudad_origen_id')->nullable()->constrained('sub_ciudad');
            $table->foreignId('sub_ciudad_destino_id')->nullable()->constrained('sub_ciudad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ruta', function (Blueprint $table) {
            //
        });
    }
}
