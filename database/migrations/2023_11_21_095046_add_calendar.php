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
        Schema::create('calendar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('start_cal');
            $table->string("end_cal");
            $table->string("backgroundColor");
            $table->unsignedBigInteger('id_pat');
            $table->foreign('id_pat')->references('id')->on('patients');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
