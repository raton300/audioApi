<?php

namespace App\Http\Controllers;

use App\Models\TypeAppareil;
use Illuminate\Http\Request;

class TypeAppareilController extends Controller
{

    public function index()
    {
        $typeAppareil = TypeAppareil::all();
        return response()->json($typeAppareil);
    }


    public function create(Request $request)
    {
        $this->validate($request,[
            'typeAppareil' => 'required',
        ]);

        $typeAppareil= new TypeAppareil();

        $typeAppareil->typeAppareil = $request->json('typeAppareil');
        $typeAppareil->save();

        return response()->json($typeAppareil);
    }



    public function show($id)
    {
        $typeAppareil = TypeAppareil::find($id);
        return response()->json($typeAppareil);
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getTypeAppareil(): \Illuminate\Http\JsonResponse
    {
        $typeAppareils = TypeAppareil::pluck('typeAppareil');
        return response()->json($typeAppareils);
    }

    public function getIdByTypeAppareil($typeAppareil):\Illuminate\Http\JsonResponse
    {
        $ta = TypeAppareil::where('typeAppareil', $typeAppareil)->first();

        if ($ta) {
            $response = [$ta->id];
            return response()->json($response);
        } else {
            return response()->json(['message' => 'Aucun enregistrement trouvé pour cette adresse e-mail.'], 404);
        }
    }
}
