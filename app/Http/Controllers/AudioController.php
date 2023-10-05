<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $audios = Audio::all(); // Récupère toutes les lignes de la table "audio"
        return response()->json($audios);
    }
}
