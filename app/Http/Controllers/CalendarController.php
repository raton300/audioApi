<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\Calendar;
use Carbon\Carbon;
use DateInterval;

class CalendarController extends Controller
{

    public function index($id_ca,$id_cab)
    {
        $calendar = Calendar::with('patient')
            ->where('id_ca', $id_ca)
            ->where('cabinet', $id_cab)
            ->get();

        $calendar->map(function ($item) {
            $item->start_cal = \Carbon\Carbon::parse($item->start_cal)->format('Y-m-d H:i:s');
            $item->end_cal = \Carbon\Carbon::parse($item->end_cal)->format('Y-m-d H:i:s');
            return $item;
        });

        $calendar->each(function ($item) {
            $item->makeHidden(['created_at', 'updated_at']);
        });

        $calendar->transform(function ($item) {
            $item['start'] = $item['start_cal'];
            unset($item['start_cal']);
            $item['end'] = $item['end_cal'];
            unset($item['end_cal']);


            if ($item["id_pat"]) {
                $item['nom_pat'] = $item['patient']->nom_pat;
                $item['prenom_pat'] = $item['patient']->prenom_pat;
                $item['telephone_pat'] = $item['patient']->telephone_pat;
                if ($item['modele_app'] !== 'null') {
                    $item['modele_app'] = str_replace('%20', ' ', $item['patient']->appareil->modele_app);
                } else {
                    $item['modele_app'] = 'fdfgdfgdfg';
                }


            } else {

                $item['nom_pat'] = 'null';
                $item['prenom_pat'] = 'null';
                $item['telephone_pat'] = 'null';
                $item['modele_app'] = 'null';
            }


            unset($item['patient']);

            return $item;
        });

        return response()->json($calendar);
    }




    public function create(Request $request)
    {
        $this->validate($request, [
            'start_cal' => 'required',
            'end_cal' => 'required',
            'backgroundColor' => 'required',
            'categorie_cal' => 'required',
            'id_ca' => 'required',
            'cabinet' => 'required',
        ]);

        try {
            $calendar = new Calendar();

            // Convertissez les valeurs JSON en objets DateTime
            $calendar->start_cal =$request->json('start_cal');
            $calendar->end_cal = $request->json('end_cal');
            $calendar->backgroundColor = $request->json('backgroundColor');
            $calendar->id_pat = $request->json('id_pat');
            $calendar->categorie_cal = $request->json('categorie_cal');
            $calendar->description_cal = $request->json('description_cal');
            $calendar->id_ca = $request->json('id_ca');
            $calendar->cabinet = $request->json('cabinet');
            $calendar->save();

            return response()->json($calendar);
        } catch (\Exception $e) {
            error_log('Exception during calendar creation: ' . $e->getMessage());
            throw $e;
        }
    }



    public function show($id)
    {
        //
    }


    public function edit($id, Request $request)
    {
        try{
            $this->validate($request, [
                'start_cal' => 'required',
            ]);
        }catch (\Exception $e){
            error_log('Exception during calendar update: ' . $e->getMessage());
            throw $e;
        }


        try {
            $calendar = Calendar::find($id);

            if (!$calendar) {
                return response()->json(['error' => 'Event not found'], 404);
            }
            $categorieCal=$request->json('categorie_cal');


            $startCal = Carbon::parse($request->json('start_cal'));

            $startCalClone = clone $startCal;
            $endCal = null;


            switch ($categorieCal) {
                case 'Facturation':
                    $startCalClone->add(new DateInterval('PT30M')); // 0.5
                    $endCal = $startCalClone->format('Y-m-d H:i:s');
                    break;
                case 'Premier RDV':
                    $startCalClone->add(new DateInterval('PT1H'));
                    $endCal = $startCalClone->format('Y-m-d H:i:s');
                    break;
                case 'Reglage':
                    $startCalClone->add(new DateInterval('PT30M')); // 0.5
                    $endCal = $startCalClone->format('Y-m-d H:i:s');
                    break;
                case 'Livraison':
                    $startCalClone->add(new DateInterval('PT1H'));
                    $endCal = $startCalClone->format('Y-m-d H:i:s');
                    break;
            }



            $calendar->start_cal = $request->json('start_cal');
            $calendar->end_cal = $endCal;
            $calendar->save();
            return response()->json($calendar);
        } catch (\Exception $e) {
            error_log('Exception during calendar update: ' . $e->getMessage());
            throw $e;
        }
    }

    public function editEtat($id, Request $request){
        $this->validate($request, [
            'etat_cal' => 'required',
        ]);

        $calendar = Calendar::find($id);

        $calendar->etat_cal = $request->json('etat_cal');
        $calendar->save();
        return response()->json($calendar);
    }
    public function destroy($id)
    {
        //
    }

    public function calendarPatient($id_pat)
    {
        $calendars = Calendar::where('id_pat', $id_pat)
            ->orderBy('start_cal', 'desc') // Tri par date de manière décroissante
            ->get();

        return response()->json($calendars);
    }



}
