<?php

namespace App\Http\Controllers;

use App\Models\Mcqs;
use Illuminate\Http\Request;

class MCQController extends Controller
{

    public function index()
    {
        $mcqs = Mcqs::all();
        return response()->json($mcqs);
    }


    public function create(Request $request)
    {
        $this->validate($request,[
            'title_mcq' => 'required',
            'category_mcq' => 'required',
        ]);

        $mcq= new Mcqs();

        $mcq->title_mcq = $request->json('title_mcq');
        $mcq->category_mcq = $request->json('category_mcq');
        $mcq->save();

        return response()->json($mcq);
    }



    public function show($id)
    {
        $mcq = Mcqs::find($id);
        return response()->json($mcq);
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
