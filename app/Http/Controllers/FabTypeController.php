<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fabriquant;
use App\Models\TypeAppareil;
class FabTypeController extends Controller
{

    public function index()
    {
        // Récupérer la liste de noms de fabriquants
        $fabriquants = Fabriquant::pluck('nom_fab');

        // Récupérer la liste de noms de types d'appareils
        $typesAppareil = TypeAppareil::pluck('typeAppareil');

        // Retourner les deux listes dans la réponse JSON
        return response()->json([
            'fabriquants' => $fabriquants,
            'typesAppareil' => $typesAppareil,
        ]);
    }

}
