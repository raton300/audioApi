<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('patients', function (Blueprint $table) {
            $table->unsignedBigInteger('id_app');
            $table->foreign('id_app')->references('id')->on('appareils');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Si nécessaire, tu peux écrire le code pour annuler les modifications ici
        });
    }
};
