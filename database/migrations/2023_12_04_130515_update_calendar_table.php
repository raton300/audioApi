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
        Schema::disableForeignKeyConstraints(); // Désactive les contraintes de clé étrangère temporairement

        Schema::table('calendars', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ca');
            $table->foreign('id_ca')->references('id')->on('centre_audio');
            $table->string('cabinet');
        });

        Schema::enableForeignKeyConstraints(); // Réactive les contraintes de clé étrangère
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
