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
        Schema::create('reponsemcqpatients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('reponse');

            $table->unsignedBigInteger('id_mcq');
            $table->foreign('id_mcq')->references('id')->on('mcqs');

            $table->unsignedBigInteger('id_pat');
            $table->foreign('id_pat')->references('id')->on('patients');

            $table->unsignedBigInteger('id_que');
            $table->foreign('id_que')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reponsemcqpatients');
    }
};
