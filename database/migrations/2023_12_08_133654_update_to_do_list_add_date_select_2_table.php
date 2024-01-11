<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new  class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_appareil', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numero_serie');

            $table->unsignedBigInteger('id_pat')->nullable()->unique();
            $table->foreign('id_pat')->references('id')->on('patients');

            $table->unsignedBigInteger('id_app')->nullable();
            $table->foreign('id_app')->references('id')->on('appareils');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_appareil');
    }
};
