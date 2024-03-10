<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * up se ejecuta cuando se ejeccutan las migraciosnes y down con el roolback
     * lo que colocamos en up debemos prograrlo pa que se elimine en el down
     * como se le puso en el nombre de la migracion to_users_table laravel identifica que hace parte de users
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            // se le agrega el ->unique para que no pérmita username duplicados 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
