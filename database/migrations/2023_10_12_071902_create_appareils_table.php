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
        Schema::create('appareils', function (Blueprint $table) {
            $table->id();
            $table->string('modele_app');
            $table->integer('annee_app');
            $table->string('photo');
            $table->unsignedBigInteger('id_fab');
            $table->foreign('id_fab')->references('id')->on('fabriquants');
            $table->unsignedBigInteger('id_ta');
            $table->foreign('id_ta')->references('id')->on('type_appareils');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appareils');
    }
};
