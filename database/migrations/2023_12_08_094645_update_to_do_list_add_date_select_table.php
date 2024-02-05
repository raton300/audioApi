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
        Schema::table('to_do_lists', function (Blueprint $table) {
            $table->string('date_tdl');
            $table->string('category');
        });
    }


    public function down(): void
    {
        Schema::table('to_do_lists', function (Blueprint $table) {
            //
        });
    }
};
