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
        Schema::create('construcciones', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 200);
            $table->string('subTipo', 200);
            $table->string('nombre_ed', 200);
            $table->string('enlace', 200);
            $table->integer('nivel');
            $table->integer('madera');
            $table->integer('barro');
            $table->integer('hierro');
            $table->integer('cereal');
            $table->integer('consumo');
            $table->integer('pc');
            $table->date('tiempo');
            $table->integer('produccion');

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
        Schema::dropIfExists('construcciones');
    }
};
