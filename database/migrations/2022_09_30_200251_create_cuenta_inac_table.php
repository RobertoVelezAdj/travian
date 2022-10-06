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
        Schema::create('cuenta_inac', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('IdCuenta');
            $table->bigInteger('IdServer');
            $table->bigInteger('IdAlianza');
            $table->string('NombreCuenta');
            $table->string('Raza');
            $table->bigInteger('Activo');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('supend_at')->nullable();
            $table->timestamp('modif_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuenta_inac');
    }
};
