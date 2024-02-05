<?php

namespace App\Http\Controllers;

use App\Models\PatientAppareil;
use App\Models\StockAppareil;
use Illuminate\Http\Request;

class StockAppareilController extends Controller
{

    public function index($id_ca, $id_cab,$condition)
    {
        if ($condition == 'all'){
            $stockAppareils = StockAppareil::where('id_ca', $id_ca)->where('cabinet', $id_cab)->get();
        }else {
            $stockAppareils = StockAppareil::where('id_ca', $id_ca)->where('cabinet', $id_cab)->where('condition_sa',$condition)->get();
        }


        $result = [];

        foreach ($stockAppareils as $stockAppareil) {
            $patientAppareil = PatientAppareil::where('id_sa', $stockAppareil->id)->first();

            if ($patientAppareil !== null) {
                $result[] = [
                    'id' => $stockAppareil->id,
                    'patient_id' => $patientAppareil->id_pat,
                    'nom_pat' => $patientAppareil->nom_pat ? $patientAppareil->nom_pat->nom_pat : null,
                    'prenom_pat' => $patientAppareil->prenom_pat ? $patientAppareil->prenom_pat->prenom_pat : null,
                    'modele_app' => str_replace('%20', ' ', $stockAppareil->appareil ? $stockAppareil->appareil->modele_app : null),
                    'numero_serie' => $stockAppareil->numero_serie,
                    'color_sa' => $stockAppareil->color_sa,
                    'sizeEarpiece_sa' => $stockAppareil->sizeEarpiece_sa,
                    'condition_sa' => $stockAppareil->condition_sa,
                ];
            } else {
                $result[] = [
                    'id' => $stockAppareil->id,
                    'patient_id' => null,
                    'nom_pat' => null,
                    'prenom_pat' => null,
                    'modele_app' => str_replace('%20', ' ', $stockAppareil->appareil ? $stockAppareil->appareil->modele_app : null),
                    'numero_serie' => $stockAppareil->numero_serie,
                    'color_sa' => $stockAppareil->color_sa,
                    'sizeEarpiece_sa' => $stockAppareil->sizeEarpiece_sa,
                    'condition_sa' => $stockAppareil->condition_sa,
                ];
            }
        }

        return response()->json($result);
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'numero_serie' => 'required',
            'cabinet' => 'required',
            'id_ca' => 'required',
            'id_app' => 'required',
        ]);

        $stockAppareil = new StockAppareil();

        $stockAppareil->numero_serie = $request->json('numero_serie');
        $stockAppareil->cabinet = $request->json('cabinet');
        $stockAppareil->id_ca = $request->json('id_ca');
        $stockAppareil->id_app = $request->json('id_app');

        $stockAppareil->color_sa = $request->json('color_sa');
        $stockAppareil->sizeEarpiece_sa = $request->json('sizeEarpiece_sa');
        $stockAppareil->condition_sa = 'stock';

        $stockAppareil->id_pat = $request->json('id_pat');

        $stockAppareil->save();

        return response()->json($stockAppareil);
    }

    public function show($id)
    {

    }

    public function update(Request $request, $numero_serie,$condition)
    {
        $this->validate($request, []);

        $stockAppareil = StockAppareil::where('numero_serie', $numero_serie)->first();

        if ($stockAppareil) {
            $stockAppareil->condition_sa = $condition;
            $stockAppareil->save();

            return response()->json($stockAppareil);
        } else {
            return response()->json(['message' => 'Aucun enregistrement trouvé.'], 404);
        }
    }


    public function destroy($id)
    {

    }

    public function byPatient($id_pat){
        $stockAppareil= StockAppareil::where('id_pat',$id_pat)->get();


        $stockAppareil = $stockAppareil->map(function ($stockAppareil){
            return [
                'id' => $stockAppareil->id,
                'nom_pat' => $stockAppareil->nom_pat ? $stockAppareil->nom_pat->nom_pat : null,
                'prenom_pat' => $stockAppareil->prenom_pat ? $stockAppareil->prenom_pat->prenom_pat : null,
                'modele_app' => str_replace('%20',' ',$stockAppareil->modele_app ? $stockAppareil->modele_app->modele_app : null),
                'numero_serie' => $stockAppareil->numero_serie,
            ];

        });


        return response()->json($stockAppareil);

    }
    public function byModele($id_ca,$id_cab,$id_app,$condition)
    {
        if ($condition == 'all'){
            $stockAppareils= StockAppareil::where('id_ca',$id_ca)->where('cabinet',$id_cab)->where('id_app',$id_app)
                ->get();
        }else {
            $stockAppareils= StockAppareil::where('id_ca',$id_ca)->where('cabinet',$id_cab)->where('id_app',$id_app)->where('condition_sa',$condition)
                ->get();
        }


        $result = [];

        foreach ($stockAppareils as $stockAppareil) {
            $patientAppareil = PatientAppareil::where('id_sa', $stockAppareil->id)->first();

            if ($patientAppareil !== null) {
                $result[] = [
                    'id' => $stockAppareil->id,
                    'patient_id' => $patientAppareil->id_pat,
                    'nom_pat' => $patientAppareil->nom_pat ? $patientAppareil->nom_pat->nom_pat : null,
                    'prenom_pat' => $patientAppareil->prenom_pat ? $patientAppareil->prenom_pat->prenom_pat : null,
                    'modele_app' => str_replace('%20', ' ', $stockAppareil->appareil ? $stockAppareil->appareil->modele_app : null),
                    'numero_serie' => $stockAppareil->numero_serie,
                    'color_sa' => $stockAppareil->color_sa,
                    'sizeEarpiece_sa' => $stockAppareil->sizeEarpiece_sa,
                    'condition_sa' => $stockAppareil->condition_sa,
                ];
            } else {
                $result[] = [
                    'id' => $stockAppareil->id,
                    'patient_id' => null,
                    'nom_pat' => null,
                    'prenom_pat' => null,
                    'modele_app' => str_replace('%20', ' ', $stockAppareil->appareil ? $stockAppareil->appareil->modele_app : null),
                    'numero_serie' => $stockAppareil->numero_serie,
                    'color_sa' => $stockAppareil->color_sa,
                    'sizeEarpiece_sa' => $stockAppareil->sizeEarpiece_sa,
                    'condition_sa' => $stockAppareil->condition_sa,
                ];
            }
        }

        return response()->json($result);

    }

    public function byFab($id_ca,$id_cab,$id_fab,$condition)
    {
        $stockAppareils = StockAppareil::where('id_ca', $id_ca)
            ->where('cabinet', $id_cab)
            ->whereHas('appareil', function ($query) use ($id_fab) {
                $query->where('id_fab', $id_fab);
            })
            ->get();

        if ($condition == 'all'){
            $stockAppareils = StockAppareil::where('id_ca', $id_ca)
                ->where('cabinet', $id_cab)
                ->whereHas('appareil', function ($query) use ($id_fab) {
                    $query->where('id_fab', $id_fab);
                })
                ->get();
        }else {
            $stockAppareils = StockAppareil::where('id_ca', $id_ca)
                ->where('cabinet', $id_cab)
                ->where('condition_sa',$condition)
                ->whereHas('appareil', function ($query) use ($id_fab) {
                    $query->where('id_fab', $id_fab);
                })
                ->get();
        }


        $result = [];

        foreach ($stockAppareils as $stockAppareil) {
            $patientAppareil = PatientAppareil::where('id_sa', $stockAppareil->id)->first();

            if ($patientAppareil !== null) {
                $result[] = [
                    'id' => $stockAppareil->id,
                    'patient_id' => $patientAppareil->id_pat,
                    'nom_pat' => $patientAppareil->nom_pat ? $patientAppareil->nom_pat->nom_pat : null,
                    'prenom_pat' => $patientAppareil->prenom_pat ? $patientAppareil->prenom_pat->prenom_pat : null,
                    'modele_app' => str_replace('%20', ' ', $stockAppareil->appareil ? $stockAppareil->appareil->modele_app : null),
                    'numero_serie' => $stockAppareil->numero_serie,
                    'color_sa' => $stockAppareil->color_sa,
                    'sizeEarpiece_sa' => $stockAppareil->sizeEarpiece_sa,
                    'condition_sa' => $stockAppareil->condition_sa,
                ];
            } else {
                $result[] = [
                    'id' => $stockAppareil->id,
                    'patient_id' => null,
                    'nom_pat' => null,
                    'prenom_pat' => null,
                    'modele_app' => str_replace('%20', ' ', $stockAppareil->appareil ? $stockAppareil->appareil->modele_app : null),
                    'numero_serie' => $stockAppareil->numero_serie,
                    'color_sa' => $stockAppareil->color_sa,
                    'sizeEarpiece_sa' => $stockAppareil->sizeEarpiece_sa,
                    'condition_sa' => $stockAppareil->condition_sa,
                ];
            }
        }

        return response()->json($result);
    }



    public function autocomplete($id_ca,$id_cab, $query)
    {
        $stockAppareils = StockAppareil::where('id_ca', $id_ca)->where('cabinet',$id_cab)->where('condition_sa','stock')
            ->where(function ($q) use ($query) {
                $q->where('numero_serie', 'LIKE', '%' . $query . '%');
            })
            ->get();

        $formattedStockAppareils = $stockAppareils->map(function ($stockAppareil) {
            return [
                'label' => $stockAppareil->numero_serie,
                'value' => $stockAppareil->id,
            ];
        });

        return response()->json($formattedStockAppareils);
    }


    public function updateCabinet(Request $request,$cabinet)
    {
        $data = $request->json()->all();

        foreach ($data as $item) {
            StockAppareil::where('id', $item['id'])->update(['cabinet' => $cabinet]);
        }

        return response()->json(['message' => 'Mise à jour réussie']);
    }


}

