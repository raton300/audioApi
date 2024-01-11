<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            // Modifie la colonne pour avoir une valeur par défaut de 1
            $table->integer('demandeRappel_pat')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            // Si nécessaire, tu peux écrire le code pour annuler les modifications ici
        });
    }
};
