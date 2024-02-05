<?php

namespace App\Http\Controllers;

use App\Models\QuestionAddMcqs;
use Illuminate\Http\Request;

class QuestionAddMCQController extends Controller
{

    public function index()
    {
        $questionAddMCQs= QuestionAddMcqs::all();
        return response()->json($questionAddMCQs);
    }


    public function create(Request $request)
    {
        $this->validate($request,[
            'id_mcq' => 'required',
            'id_que' => 'required',
        ]);
        $questionAddMCQ = new QuestionAddMcqs();
        $questionAddMCQ->id_mcq = $request->json('id_mcq');
        $questionAddMCQ->id_que = $request->json('id_que');

        $questionAddMCQ->save();

        return response()->json($questionAddMCQ);
    }




    public function show($id_mcq)
    {
        $questionAddMCQs= QuestionAddMcqs::where('id_mcq', $id_mcq)
            ->with([
                'content_que' => function ($query) {
                    $query->select('id', 'content_que');
                },
            ])
            ->get();
        $questionAddMCQs = $questionAddMCQs->map(function ($questionAddMCQs) {
            return [
                'id' => $questionAddMCQs->id,
                'question' => $questionAddMCQs->content_que ? $questionAddMCQs->content_que->content_que:null,
            ];

        });
        return response()->json($questionAddMCQs);
    }




    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {

        $questionAddMCQ = QuestionAddMcqs::find($id);
        if (!$questionAddMCQ) {
            return response()->json('L\'élément n\'a pas été trouvé.', 404);
        }
        $questionAddMCQ->delete();
        return response()->json('Supp');
    }
}
