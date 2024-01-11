<?php

namespace App\Http\Controllers;


use App\Models\Audio;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Models\Patient;



class PatientController extends Controller
{

    public function index()
    {

        $patient = Patient::with([
            'audio' => function ($query){
                $query->select('id','nom_aud');
            },
            'appareil' => function ($query){
                $query->select('id','modele_app');
            }
        ])->get();

        $patient = $patient->map(function ($patient){


            return [
                'id' => $patient->id,
                'nom_pat' => $patient->nom_pat,
                'prenom_pat' => $patient->prenom_pat,
                'telephone_pat' => $patient->telephone_pat,
                'dernierRDV_pat' => $patient->dernierRDV_pat,
                'assurance_pat' => $patient->assurance_pat,
                'modele_app' => str_replace('%20',' ',$patient->appareil ? $patient->appareil->modele_app : null),
                'nom_aud' => $patient->audio ? $patient->audio->nom_aud : null,
                'id_ca' => $patient->id_ca,
                'date_pat' => $patient->date_pat,
                'adresse_pat' =>$patient->adresse_pat,
                'mail_pat' =>$patient->mail_pat,
                'cp_pat' =>$patient->cp_pat,
                'ville_pat' =>$patient->ville_pat,
            ];

        });

        return response()->json($patient);
    }



    public function create(Request $request,$id_ca)
    {
        $this->validate($request, [
            'nom_pat' => 'required',
            'prenom_pat' => 'required',
            'sexe_pat' => 'required',
        ]);
        try {
            $patient = new Patient();


            $patient->nom_pat = $request->json('nom_pat');
            $patient->prenom_pat = $request->json('prenom_pat');
            $patient->sexe_pat = $request->json('sexe_pat');
            $patient->id_ca = $id_ca;

            if ($request->has('telephone_pat')) {
                $patient->telephone_pat = $request->json('telephone_pat');
            }
            if ($request->has('date_pat')) {
                $patient->date_pat = $request->json('date_pat');
            }
            if ($request->has('adresse_pat')) {
                $patient->adresse_pat = $request->json('adresse_pat');
            }
            if ($request->has('mail_pat')) {
                $patient->mail_pat = $request->json('mail_pat');
            }
            if ($request->has('ville_pat')) {
                $patient->ville_pat = $request->json('ville_pat');
            }
            if ($request->has('cp_pat')) {
                $patient->cp_pat = $request->json('cp_pat');
            }
            if ($request->has('ss_pat')) {
                $patient->ss_pat = $request->json('ss_pat');
            }
            $patient->save();

            if ($request->json('parrainer_pat') != null){
                $sponsorship = new Sponsorship();

                $patGodfather = Patient::where('nom_pat', $request->json('parrainer_pat'))->first();
                $idPatGodfather = $patGodfather->getKey();

                $sponsorship->id_pat_parrain = $idPatGodfather;
                $sponsorship->id_pat_filleul = $patient->id;
                $sponsorship->save();
                // Créer un tableau avec les deux modèles
                $responseData = ['sponsorship' => $sponsorship, 'patient' => $patient];

                // Retourner le tableau avec response()->json()
                return response()->json($responseData);
            } else {
                // Retourner le patient seul si parrainer_pat est null
                return response()->json($patient);
            }


        }catch (\Exception $e) {
            error_log('Exception during patient creation: ' . $e->getMessage());
            throw $e;
        }

    }

    public function show($id,$id_ca)
    {
        $patient = Patient::with([
            'audio' => function ($query) {
                $query->select('id', 'nom_aud');
            },
            'appareil' => function ($query) {
                $query->select('id', 'modele_app', 'id_fab','id_ta')
                    ->with('fabriquant:id,nom_fab')
                    ->with('typeAppareil:id,typeAppareil');
            },
        ])->find($id);


        if (!$patient) {
            // Gérer le cas où le patient n'est pas trouvé
            return response()->json(['message' => 'Patient non trouvé.'], 404);
        }
        if ($id_ca==$patient->id_ca){
            $creat =substr( $patient->created_at, 0, 10);
            $creat = implode('/', array_reverse(explode('-',$creat)));

            $patient = [
                'id' => $patient->id,
                'nom_pat' => $patient->nom_pat,
                'prenom_pat' => $patient->prenom_pat,
                'telephone_pat' => $patient->telephone_pat,
                'dernierRDV_pat' => $patient->dernierRDV_pat,
                'assurance_pat' => $patient->assurance_pat,
                'nom_aud' => $patient->audio ? $patient->audio->nom_aud : null,
                'id_ca' => $patient->id_ca,
                'date_pat' => $patient->date_pat,
                'adresse_pat' =>$patient->adresse_pat,
                'mail_pat' =>$patient->mail_pat,
                'ville_pat' =>$patient->ville_pat,
                'cp_pat' =>$patient->cp_pat,
                'creat_pat' =>$creat,
                'modele_app' => str_replace('%20', ' ', $patient->appareil ? $patient->appareil->modele_app : null),
                'fabricant_app' => $patient->appareil && $patient->appareil->fabriquant ? $patient->appareil->fabriquant->nom_fab : null,
                'type_app' => $patient->appareil && $patient->appareil->typeAppareil ? $patient->appareil->typeAppareil->typeAppareil : null,
            ];
            return response()->json($patient);
        }else{
            return response()->json("error");
        }
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, []);

        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }
        $propertyName = null;

        switch (true) {
            case $request->json('nom_pat'):
                $propertyName = 'nom_pat';
                break;
            case $request->json('prenom_pat'):
                $propertyName = 'prenom_pat';
                break;
            case $request->json('telephone_pat'):
                $propertyName = 'telephone_pat';
                break;
            case $request->json('mail_pat'):
                $propertyName = 'mail_pat';
                break;
            case $request->json('cp_pat'):
                $propertyName = 'cp_pat';
                break;
            case $request->json('ville_pat'):
                $propertyName = 'ville_pat';
                break;
            case $request->json('adresse_pat'):
                $propertyName = 'adresse_pat';
                break;
            case $request->json('date_pat'):
                $propertyName = 'date_pat';
                break;
            case $request->json('assurance_pat'):
                $propertyName = 'assurance_pat';
                break;
            case $request->json('dernierRDV_pat'):
                $propertyName = 'dernierRDV_pat';
                break;
            case $request->json('id_app'):
                $propertyName = 'id_app';
                break;
            case $request->json('demandeRappel_pat'):
                $propertyName = 'demandeRappel_pat';
                break;
        }

        if ($propertyName !== '' || $propertyName == 'demandeRappel_pat') {

            if ($propertyName === 'assurance' && $request->json($propertyName) == 0) {
                return response()->json(['message' => 'Erreur : assurance égale à 0.'], 400);
            }


            $patient->$propertyName = $request->json($propertyName);
            $patient->save();

            return response()->json($patient);
        } else {
            return response()->json(['message' => 'Erreur de l envoi lors de la requete, mauvais parametre'], 404);
        }
    }




    public function destroy($id)
    {
        //
    }
    public function getByNom($nom_pat){
        $response = Patient::where('nom_pat', $nom_pat)->first();

        return response()->json($response);

    }
    public function getNom($centreAudio){
        $patients = Patient::where('id_ca',$centreAudio)->get();
        $noms = [];

        foreach ($patients as $patient) {
            $noms[] = [
                'label' => $patient->nom_pat,
                'value' => $patient->id
            ];

        }

        return response()->json($noms);
    }

    public function getIdByNom($nom_pat){
        $patient = Patient::where('nom_pat', $nom_pat)->first();

        if ($patient) {
            $response = [$patient->id];
            return response()->json($response);
        } else {
            return response()->json(['message' => 'Aucun enregistrement trouvé pour cette adresse e-mail.'], 404);
        }

    }

    public function getPatientRequest($id_ca) {
        $count = Patient::where('demandeRappel_pat', 'oui')->where('id_ca', $id_ca)->count();
        $patients =Patient::where('demandeRappel_pat', 'oui')->where('id_ca', $id_ca)->get();
        return response()->json(['count' => $count,'patients' => $patients]);
    }

    public function patientCount($id_ca){
        $countPatient = Patient::where('id_ca', $id_ca)->count();
        $countPatientAss = Patient::where('id_ca', $id_ca)->where('assurance_pat', 1)->count();

        $percentage = ($countPatientAss*100)/$countPatient;
        $oneMonth= date("m");
        $countNewPatient = Patient::where('id_ca', $id_ca)->whereMonth('created_at',$oneMonth)->count();

        return response()->json(['countPatient' => $countPatient,'countPatientAss' => $countPatientAss,'percentage' => intval($percentage),'countNewPatient' => $countNewPatient]);
    }

    public function autocomplete($id_ca, $query)
    {
        $patients = Patient::where('id_ca', $id_ca)
            ->where(function ($q) use ($query) {
                $q->where('nom_pat', 'LIKE', '%' . $query . '%')
                    ->orWhere('prenom_pat', 'LIKE', '%' . $query . '%')
                    ->orWhere('telephone_pat', 'LIKE', '%' . $query . '%');
            })
            ->get();

        $formattedPatients = $patients->map(function ($patient) {
            return [
                'label' => $patient->nom_pat . ' ' . $patient->prenom_pat . ' - ' . $patient->telephone_pat,
                'value' => $patient->id,
            ];
        });

        return response()->json($formattedPatients);
    }




}
