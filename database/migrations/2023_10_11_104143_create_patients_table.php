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
        Schema::create('patient', function (Blueprint $table) {
            $table->id('id_pat');
            $table->string('nom_pat');
            $table->string('prenom_pat');
            $table->string('telephone_pat');
            $table->date('dernierRDV_pat');
            $table->integer('demandeRappel_pat');

            $table->unsignedBigInteger('audio_id');
            $table->foreign('audio_id')->references('id')->on('audio');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
