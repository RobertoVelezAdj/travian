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
        Schema::table('users', function (Blueprint $table) {
            //creación campos especificos travian
            $table->string('login')->after('name')->nullable();
            $table->string('alianza')->after('name')->nullable();
            $table->string('servidor')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //borrado campos especificos travian
            $table->dropColumn('login');
            $table->dropColumn('alianza');
            $table->dropColumn('servidor');
        });
    }
};
