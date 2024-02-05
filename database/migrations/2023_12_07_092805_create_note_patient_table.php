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
        Schema::create('note_patient', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('content_np');


            $table->unsignedBigInteger('id_pat');
            $table->foreign('id_pat')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_patient');
    }
};
