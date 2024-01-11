<?php

namespace App\Http\Controllers;

use App\Models\CentreAudio;
use Illuminate\Http\Request;

class CentreAudioController extends Controller
{

    public function index()
    {
        $CentreAudio = CentreAudio::all();
        return response()->json($CentreAudio);
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'nom_ca' => 'required',
            'email_ca' => 'required',
            'pass_ca' => 'required',
        ]);
        $centreAudio = new CentreAudio();


        $centreAudio->nom_ca = $request->json('nom_ca');
        $centreAudio->email_ca = $request->json('email_ca');
        $centreAudio->pass_ca = $request->json('pass_ca');

        $centreAudio->save();

        return response()->json($centreAudio);
    }


    public function show($id)
    {
        $CentreAudio = CentreAudio::find($id);
        return response()->json($CentreAudio);
    }



    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
    public function getByEmail($email_ca)
    {
        $email_ca = urldecode($email_ca);

        $centreAudio = CentreAudio::where('email_ca', $email_ca)->first();

        if ($centreAudio) {
            $response = [
                'id' => $centreAudio->id,
                'pass_ca' => $centreAudio->pass_ca,
                'email_ca' => $centreAudio->email_ca,
                'nom_ca' => $centreAudio->nom_ca,
            ];
            return response()->json($response);
        } else {
            return response()->json(['message' => 'Aucun enregistrement trouvé pour cette adresse e-mail.'], 404);
        }
    }
}
