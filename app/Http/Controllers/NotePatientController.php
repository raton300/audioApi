<?php

namespace App\Http\Controllers;

use App\Models\NotePatientModel;
use Illuminate\Http\Request;

class NotePatientController extends Controller
{

    public function index()
    {
        $notePatients = NotePatientModel::all();
        return response()->json($notePatients);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'content_np' => 'required',
            'id_pat' => 'required',
        ]);
        $notePatient = new NotePatientModel();



        $notePatient->content_np = $request->json('content_np');
        $notePatient->id_pat = $request->json('id_pat');
        $notePatient->save();

        return response()->json($notePatient);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function destroy($id)
    {

        $notePatient = NotePatientModel::find($id);
        if (!$notePatient) {
            return response()->json('L\'élément n\'a pas été trouvé.', 404);
        }
        $notePatient->delete();
        return response()->json('Supp');
    }

    public  function byPatient($id_pat){
        $notePatients = NotePatientModel::where('id_pat',$id_pat)->get();
        return response()->json($notePatients);
    }
}
