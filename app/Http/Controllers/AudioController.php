<?php

namespace App\Http\Controllers;


use App\Models\Audio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AudioController extends Controller
{

    public function index($id_ca)
    {
        $audios = Audio::with([
            'centreAudio' => function ($query)  use ($id_ca){
                $query->select('id','nom_ca');

            },
        ])->where('id_ca', $id_ca)->get();


        $audios = $audios->map(function($audios){
            return [
                'id' => $audios->id,
                'nom_aud' => $audios->nom_aud,
                'prenom_aud' => $audios->prenom_aud,
                'telephone_aud' => $audios->telephone_aud,
                'photo_aud' => $audios->photo_aud,
                'email_aud' => $audios->email_aud,
                'nom_ca' => $audios->centreAudio ? $audios->centreAudio->nom_ca : null,
            ];
        });
        return response()->json($audios);
    }


    public function create(Request $request)
    {

        $this->validate($request, [
            'nom_aud' => 'required',
            'prenom_aud' => 'required',
            'telephone_aud' => 'required',
            'email_aud' => 'required',
            'id_ca' => 'required',
        ]);
        $audio = new Audio();



        $audio->nom_aud = $request->json('nom_aud');
        $audio->prenom_aud = $request->json('prenom_aud');
        $audio->telephone_aud = $request->json('telephone_aud');
        $audio->email_aud = $request->json('email_aud');
        $audio->id_ca = $request->json('id_ca');
        $audio->save();

        return response()->json($audio);
    }


    public function show($id)
    {
        $audios = Audio::find($id);
        return response()->json($audios);
    }


    public function edite(Request $request, $id)
    {
        $this->validate($request, [
            'nom_aud' => 'required',
            'prenom_aud' => 'required',
            'telephone_aud' => 'required',
            'photo_aud' => 'required',
            'email_aud' => 'required',
        ]);


        $audio = Audio::find($id);

        if (!$audio) {

            return response()->json(['message' => 'Audio not found'], 404);
        }


        $audio->nom_aud = $request->json('nom_aud');
        $audio->prenom_aud = $request->json('prenom_aud');
        $audio->telephone_aud = $request->json('telephone_aud');
        $audio->photo_aud = $request->json('photo_aud');
        $audio->email_aud = $request->json('email_aud');

        // Sauvegarder les modifications
        $audio->save();

        return response()->json($audio);
    }



    public function destroy($id)
    {
        $audios = Audio::find($id);
        $audios->delete();
        return response()->json('Supp');
    }

    public function getbyemail($email_aud)
    {
        $email_aud = urldecode($email_aud);

        $audio = Audio::where('email_aud', $email_aud)->first();

        if ($audio) {
            $response = [
                'id' => $audio->id,
                'pass_aud' => $audio->pass_aud,
                'email_aud' => $audio->email_aud,
                'nom_aud' => $audio->nom_aud,
            ];
            return response()->json($response);
        } else {
            return response()->json(['message' => 'Aucun enregistrement trouvé pour cette adresse e-mail.'], 404);
        }
    }

    public function getNomId(){
        $audios = Audio::all();
        $audioData = [];

        foreach ($audios as $audio) {
            $audioData[] = [
                'label' => $audio->nom_aud,
                'value' => $audio->id
            ];
        }

        return response()->json($audioData);
    }

}
