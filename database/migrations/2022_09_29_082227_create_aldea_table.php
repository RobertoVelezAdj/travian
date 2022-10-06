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
        Schema::create('aldea', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->bigInteger('coord_x');
            $table->bigInteger('coord_y');
            $table->string('nombre');
            $table->bigInteger('puntos_cultura');
            $table->bigInteger('madera');
            $table->bigInteger('barro');
            $table->bigInteger('hierro');
            $table->bigInteger('cereal');
            $table->bigInteger('id_cuenta')->index();
            $table->string('tipo');
            $table->boolean('fiesta_grande');
            $table->boolean('fiesta_pequena');
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
        Schema::dropIfExists('aldea');
    }
};
