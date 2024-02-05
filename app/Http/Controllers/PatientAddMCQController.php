<?php

namespace App\Http\Controllers;

use App\Models\PatientAddMCQ;
use Illuminate\Http\Request;

class PatientAddMCQController extends Controller
{

    public function index()
    {


        $patientAddMCQs = PatientAddMCQ::
            with([
                'nom_pat' => function ($query) {
                    $query->select('id', 'nom_pat');
                },
                'prenom_pat' => function ($query) {
                    $query->select('id', 'prenom_pat');
                },
                'title_mcq' => function ($query) {
                    $query->select('id', 'title_mcq');
                }

            ])->get();

        $patientAddMCQs = $patientAddMCQs->map(function ($patientAddMCQs) {
            return [
                'id' => $patientAddMCQs->id,
                'nom' => $patientAddMCQs->nom_pat ? $patientAddMCQs->nom_pat->nom_pat:null,
                'title' => $patientAddMCQs->title_mcq ? $patientAddMCQs->title_mcq->title_mcq:null,
                'prenom' => $patientAddMCQs->prenom_pat ? $patientAddMCQs->prenom_pat->prenom_pat:null,
                'etat_pam' => $patientAddMCQs->etat_pam,
            ];
        });
        return response()->json($patientAddMCQs);
    }


    public function create(Request $request)
    {
        $this->validate($request,[
            'id_mcq' => 'required',
            'id_pat' => 'required',
        ]);
        $patientAddMCQ = new PatientAddMCQ;

        $patientAddMCQ->id_mcq = $request->json('id_mcq');
        $patientAddMCQ->id_pat = $request->json('id_pat');
        $patientAddMCQ->save();

        return response()->json($patientAddMCQ);
    }

    public function show($id_mcq)
    {
        $patientAddMCQs = PatientAddMCQ::where('id_mcq',$id_mcq)
            ->with([
            'nom_pat' => function ($query) {
                $query->select('id', 'nom_pat');
            },
            'prenom_pat' => function ($query) {
                $query->select('id', 'prenom_pat');
            },
            'title_mcq' => function ($query) {
                $query->select('id', 'title_mcq');
            }

        ])->get();

        $patientAddMCQs = $patientAddMCQs->map(function ($patientAddMCQs) {
            return [
                'id' => $patientAddMCQs->id,
                'nom' => $patientAddMCQs->nom_pat ? $patientAddMCQs->nom_pat->nom_pat:null,
                'title' => $patientAddMCQs->title_mcq ? $patientAddMCQs->title_mcq->title_mcq:null,
                'prenom' => $patientAddMCQs->prenom_pat ? $patientAddMCQs->prenom_pat->prenom_pat:null,
                'etat_pam' => $patientAddMCQs->etat_pam,
            ];
        });
        return response()->json($patientAddMCQs);
    }
    public function edit(Request $request,$id)
    {
        $this->validate($request, []);

        $patientAddMCQ = PatientAddMCQ::find($id);
        if (!$patientAddMCQ) {
            return response()->json(['message' => 'Patient not found'], 404);
        }
        $patientAddMCQ->etat_pam = $request->json("etat_pam");
        $patientAddMCQ->save();
        return response()->json($patientAddMCQ);
    }

    public function destroy($id)
    {
        $patientAddMCQ = PatientAddMCQ::find($id);
        if (!$patientAddMCQ) {
            return response()->json('L\'élément n\'a pas été trouvé.', 404);
        }
        $patientAddMCQ->delete();
        return response()->json('Supp');
    }

    public function mcqByPatient($id_pat){
        $patientAddMCQs = PatientAddMCQ::
        where('id_pat',$id_pat)
        ->with([
            'nom_pat' => function ($query) {
                $query->select('id', 'nom_pat');
            },
            'prenom_pat' => function ($query) {
                $query->select('id', 'prenom_pat');
            },
            'title_mcq' => function ($query) {
                $query->select('id', 'title_mcq');
            }
        ])->get();

        $patientAddMCQs = $patientAddMCQs->map(function ($patientAddMCQs) {
            return [
                'id' => $patientAddMCQs->id,
                'nom' => $patientAddMCQs->nom_pat ? $patientAddMCQs->nom_pat->nom_pat:null,
                'title' => $patientAddMCQs->title_mcq ? $patientAddMCQs->title_mcq->title_mcq:null,
                'prenom' => $patientAddMCQs->prenom_pat ? $patientAddMCQs->prenom_pat->prenom_pat:null,
                'etat_pam' => $patientAddMCQs->etat_pam,
            ];
        });
        return response()->json($patientAddMCQs);
    }
}
