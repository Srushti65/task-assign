<?php

namespace App\Http\Controllers;
use App\Models\FormData;

use Illuminate\Http\Request;

class FormController extends Controller
{
    //

    public function submit(Request $req)
    {
        
        // $vd = $req->data->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email',
        // ]);

        $vd = $req->data;
       
        FormData::create($vd);
        // $assign = new assign();
        // $assign->$req->task_id = $task->id;
        // $assign->$req->user_id = $req->assigned_to;
        // $assign->save();

        $newUser = new FormData;
        $newUser->name = $req->data->name;
        $newUser->email = $req->data->email;
        $newUser->save();


    
        return response()->json(['message' => 'form submitted successfully']);
    }

    public function showAll()
    {
        $users = FormData::all();
        return $users;
    }
}
