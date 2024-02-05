<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index()
    {
        $questions= Questions::all();
        return response()->json($questions);
    }


    public function create(Request $request)
    {
        $this->validate($request,[
            'content_que' => 'required',
            'type_que' => 'required',
        ]);

        $question= new Questions();

        $question->content_que = $request->json('content_que');
        $question->type_que = $request->json('type_que');
        $question->save();

        return response()->json($question);
    }


    public function show($id)
    {
        $question= Questions::find($id);
        return response()->json($question);
    }


    public function edit($id)
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
}
