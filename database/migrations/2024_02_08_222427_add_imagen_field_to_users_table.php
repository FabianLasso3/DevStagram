<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() 
    {
        Schema::table('users', function (Blueprint $table) {
            //como el campo no es obligatorio se le pone nullable
            $table->string('imagen')->nullable();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //eliminar columna
            $table->dropColumn('imagen');
        });
    }
};
