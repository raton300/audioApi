<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{


    public function index()
    {
        $sponsorship = Sponsorship::all();
        return response()->json($sponsorship);
    }



    public function create()
    {

    }



    public function show($id)
    {

    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {
        //        $questionAddMCQs= QuestionAddMcqs::where('id_mcq', $id_mcq)
        //
        //            ->get();
    }
    public function godfather($id_pat)
    {
        $sponsorships = Sponsorship::where('id_pat_filleul', $id_pat)
            ->with([
                'nomParrain' => function ($query) {
                    $query->select('id', 'nom_pat');
                },
                'prenomParrain' => function ($query) {
                    $query->select('id', 'prenom_pat');
                },
                'idParrain' => function ($query) {
                    $query->select('id', 'id');
                },
            ])
            ->get();

        $sponsorships = $sponsorships->map(function ($sponsorship) {
            return [
                'id_parrain' => $sponsorship->idParrain ? $sponsorship->idParrain->id : null,
                'nom_parrain' => $sponsorship->nomParrain ? $sponsorship->nomParrain->nom_pat : null,
                'prenom_parrain' => $sponsorship->prenomParrain ? $sponsorship->prenomParrain->prenom_pat : null,
            ];
        });

        return response()->json($sponsorships);
    }

    public function godson($id_pat)
    {
        $sponsorships = Sponsorship::where('id_pat_parrain', $id_pat)
            ->with([
                'nomFilleul' => function ($query) {
                    $query->select('id', 'nom_pat');
                },
                'prenomFilleul' => function ($query) {
                    $query->select('id', 'prenom_pat');
                },
                'idFilleul' => function ($query) {
                    $query->select('id', 'id');
                },
            ])
            ->get();

        $sponsorships = $sponsorships->map(function ($sponsorship) {
            return [
                'id_filleul' => $sponsorship->idFilleul ? $sponsorship->idFilleul->id : null,
                'nom_filleul' => $sponsorship->nomFilleul ? $sponsorship->nomFilleul->nom_pat : null,
                'prenom_filleul' => $sponsorship->prenomFilleul ? $sponsorship->prenomFilleul->prenom_pat : null,
            ];
        });

        return response()->json($sponsorships);
    }
}
