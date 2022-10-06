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
        Schema::create('servidor', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 200);
            $table->string('ruta', 200);
            $table->string('ruta_inac', 200);
            $table->date('fch_creac');
            $table->date('fch_mod');
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
        Schema::dropIfExists('servidor');
    }
};
