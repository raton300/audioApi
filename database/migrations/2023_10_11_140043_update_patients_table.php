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
        Schema::table('patients', function (Blueprint $table) {
            // Modifie la colonne pour avoir une valeur par défaut de 1
            $table->integer('assurance_pat')->default(0);
        });
    }


    public function down(): void
    {
        //
    }
};
