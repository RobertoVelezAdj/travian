<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aldea_inac', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('IdCuenta');
            $table->string('NombreAldea');
            $table->bigInteger('coord_x');
            $table->bigInteger('coord_y');
            $table->bigInteger('poblacion');
            $table->bigInteger('id_server');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aldea_inac');
    }
};
