<?php

namespace App\Http\Controllers;

use App\Models\Fabriquant;
use Illuminate\Http\Request;

class FabriquantController extends Controller
{

    public function index()
    {
        $fabriquant= Fabriquant::all();
        return response()->json($fabriquant);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'nom_fab' => 'required',
        ]);

        $fabriquant= new Fabriquant();

        $fabriquant->nom_fab = $request->json('nom_fab');
        $fabriquant->save();

        return response()->json($fabriquant);
    }

    public function show($id)
    {
        $fabriquant= Fabriquant::find($id);
        return response()->json($fabriquant);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
    public function getNomFab(){
        $fabriquant = Fabriquant::pluck('nom_fab');
        return response()->json($fabriquant);
    }
    public function getIdByNomFab($nom_fab):\Illuminate\Http\JsonResponse
    {
        $fabriquant = Fabriquant::where('nom_fab', $nom_fab)->first();

        if ($fabriquant) {
            $response = [$fabriquant->id];
            return response()->json($response);
        } else {
            return response()->json(['message' => 'Aucun enregistrement trouvé pour cette adresse e-mail.'], 404);
        }
    }

    public function getIdNomFab():\Illuminate\Http\JsonResponse
    {
        $fabriquants = Fabriquant::all();

        if ($fabriquants) {
            $fabs = [];

            foreach ($fabriquants as $fabriquant) {
                $fabs[] = [
                    'label' => $fabriquant->nom_fab,
                    'value' => $fabriquant->id
                ];

            }
            return response()->json($fabs);
        } else {
            return response()->json(['message' => 'Aucun enregistrement trouvé pour cette adresse e-mail.'], 404);
        }
    }
}
