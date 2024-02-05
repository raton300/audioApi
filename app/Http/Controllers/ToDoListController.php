<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{

    public function index($id_ca)
    {
        $toDoList = ToDoList::where('id_ca',$id_ca)
            ->orderBy('date_tdl', 'asc')
            ->get();



        $toDoList = $toDoList->map(function ($toDoList) {
            switch ($toDoList->category_tdl){
                case 'Facturation':
                    $color = '#F70CCC';
                    break;
                case 'Autre':
                    $color = '#20EDCE';
                    break;
                default:
                    $color = '#20EDCE';
                    break;
            }
            return [
                'id_tdl' => $toDoList->id,
                'text_tdl' => $toDoList->text_tdl,
                'category_tdl' => $toDoList->category_tdl,
                'date_tdl' => implode('/', array_reverse(explode('-',$toDoList->date_tdl))),
                'background_tdl' => $color,
            ];
        });


        return response()->json($toDoList);
    }


    public function create(Request $request)
    {
        try{
            $this->validate($request, [
                'text_tdl' => 'required',
                'id_ca' => 'required',
            ]);
            $toDoList = new ToDoList();
            $toDoList->text_tdl =$request->json('text_tdl');
            $toDoList->id_ca = $request->json('id_ca');
            $toDoList->date_tdl =$request->json('date_tdl');
            $toDoList->category_tdl = $request->json('category_tdl');
            $toDoList->save();

            return response()->json($toDoList);
        }catch (\Exception $e) {
            error_log('Exception during calendar creation: ' . $e->getMessage());
            throw $e;
        }

    }



    public function show($id)
    {
        $toDoList = ToDoList::find($id);
        return response()->json($toDoList);
    }


    public function edit($id,Request $request)
    {

    }


    public function destroy($id)
    {
        $toDoList = ToDoList::find($id);
        if (!$toDoList) {
            return response()->json('L\'élément n\'a pas été trouvé.', 404);
        }
        $toDoList->delete();
        return response()->json('Supp');
    }
}
