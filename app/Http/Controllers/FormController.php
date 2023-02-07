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

        $temp = $req->data;
       
        // FormData::create($vd);
          
        $newUser = new FormData();
        $newUser->name = $temp['name'];
        $newUser->email = $temp['email'];
        
        $newUser->save();


    
        return response()->json(['message' => 'form submitted successfully']);
    }

    public function showAll()
    {
        $users = FormData::all();
        return $users;
    }
}
