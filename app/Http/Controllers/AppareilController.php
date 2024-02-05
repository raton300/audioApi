<?php

namespace App\Http\Controllers;

use App\Models\Appareil;
use Illuminate\Http\Request;

class AppareilController extends Controller
{

    public function index()
    {
        $appareils = Appareil::with([
            'typeAppareil' => function ($query) {
                $query->select('id', 'typeAppareil');
            },
            'fabriquant' => function ($query) {
                $query->select('id', 'nom_fab');
            },
        ])->get();


        $appareils = $appareils->map(function ($appareil) {
            return [
                'id' => $appareil->id,
                'modele_app' => $appareil->modele_app,
                'annee_app' => $appareil->annee_app,
                'photo_app' => $appareil->photo_app,
                'nom_fab' => $appareil->fabriquant ? $appareil->fabriquant->nom_fab : null,
                'type_appareil' => $appareil->typeAppareil ? $appareil->typeAppareil->typeAppareil : null,
            ];
        });

        return response()->json($appareils);
    }




    public function create(Request $request)
    {
        $this->validate($request, [
            'modele_app' => 'required',
            'id_fab' => 'required|integer',
            'id_ta' => 'required|integer',
        ]);

        $appareil = new Appareil();

        $appareil->modele_app = $request->json('modele_app');
        $appareil->annee_app = $request->json('annee_app');
        $appareil->photo_app = $request->json('photo_app');
        $appareil->id_fab = $request->json('id_fab');
        $appareil->id_ta = $request->json('id_ta');

        $appareil->save();

        return response()->json($appareil);
    }



    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function getModele()
    {
        $appareil = Appareil::pluck('modele_app');

        // Remplace tous les %20 par des espaces dans chaque élément du tableau
        $appareil = array_map(function ($modele) {
            return  ;
        }, $appareil->toArray());

        return response()->json($appareil);
    }

    public function getIdByModeleApp($modele_app){
        $mod= Appareil::where('modele_app', $modele_app)->first();
        $response = [$mod->id];
        return response()->json($response);
    }

    public function getModeleId(){
        $appareils = Appareil::all();
        $modeles = [];

        foreach ($appareils as $appareil) {
            $modeles[] = [
                'label' =>  str_replace('%20', ' ', $appareil->modele_app),
                'value' => $appareil->id
            ];
        }

        return response()->json($modeles);
    }
    public function getAppByAppareil($id_fab){
        $appareils = Appareil::where('id_fab',$id_fab)->get();
        $modeles = [];

        foreach ($appareils as $appareil) {
            $modeles[] = [
                'label' =>  str_replace('%20', ' ', $appareil->modele_app),
                'value' => $appareil->id
            ];
        }

        return response()->json($modeles);
    }

}
