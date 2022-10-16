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
        Schema::create('lista_vacas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('IdAldea');
            $table->bigInteger('IdServer');
            $table->bigInteger('IdAldeaVaca');
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
        Schema::dropIfExists('lista_vacas');
    }
};
