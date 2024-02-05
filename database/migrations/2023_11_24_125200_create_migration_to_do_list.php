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
        Schema::create('toDoList', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('text_tdl');
            $table->unsignedBigInteger('id_ca');
            $table->foreign('id_ca')->references('id')->on('centre_audio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('migration_to_do_list');
    }
};
