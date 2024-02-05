<?php

namespace App\Http\Controllers;

use App\Models\PatientAppareil;
use App\Models\StockAppareil;
use Illuminate\Http\Request;

class PatientAppareilsController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'numero_serie' => 'required',
            'id_pat' => 'required',
        ]);
        $id_sa = StockAppareil::where('numero_serie', $request->json('numero_serie'))->value('id');

        $patientAppareil = new PatientAppareil();

        $patientAppareil->id_sa = $id_sa;
        $patientAppareil->id_pat = $request->json('id_pat');

        $patientAppareil->save();



        return response()->json($patientAppareil);
    }

    public function getappareilbypatient($id_pat)
    {
        $patientAppareil = PatientAppareil::with([
            'stockAppareil:id,numero_serie,color_sa,sizeEarpiece_sa,id_app',
            'stockAppareil.appareil:id,modele_app',
        ])
            ->where('id_pat', $id_pat)
            ->first();

        if ($patientAppareil) {
            $creat = substr($patientAppareil->created_at, 0, 10);
            $creat = implode('/', array_reverse(explode('-', $creat)));
            $patientAppareil->stockAppareil->appareil->modele_app = str_replace('%20', ' ', $patientAppareil->stockAppareil->appareil->modele_app);
            $response = [
                'id' => $patientAppareil->id,
                'id_pat' => $patientAppareil->id_pat,
                'id_sa' => $patientAppareil->id_sa,
                'creat_pat' => $creat,
                'stockAppareil' => $patientAppareil->stockAppareil,
            ];

            return response()->json($response);
        } else {
            return response()->json(['message' => 'Aucun enregistrement trouvé.'], 404);
        }
    }




}
