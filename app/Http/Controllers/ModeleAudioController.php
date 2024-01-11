<?php

namespace App\Http\Controllers;

use App\Models\Appareil;
use App\Models\Audio;
use Illuminate\Http\Request;

class ModeleAudioController extends Controller
{

    public function index($centreAudio)
    {
        // Récupérer la liste de noms de fabriquants avec leurs ID
        $audio = Audio::whereHas('centreAudio', function ($query) use ($centreAudio) {
                $query->where('id_ca', $centreAudio);
            })
            ->pluck('nom_aud', 'id')->map(function ($nom, $id) {
            return [
                'label' => $nom,
                'value' => $id,
            ];
        })->values();

        // Récupérer la liste de noms de types d'appareils avec leurs ID
        $appareil = Appareil::pluck('modele_app', 'id')->map(function ($modele, $id) {
            return [
                'label' =>  str_replace('%20',' ',$modele),
                'value' => $id,
            ];
        })->values();

        // Retourner les deux listes dans la réponse JSON
        return response()->json([
            'nom_aud' => $audio,
            'modele_app' => $appareil,
        ]);
    }


}
