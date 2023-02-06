<?php

namespace App\Http\Controllers;
use App\Models\FormData;

use Illuminate\Http\Request;

class FormController extends Controller
{
    //

    public function submit(Request $req)
    {
        
        $vd = $req->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);
       
        FormData::create($vd);

    
        return response()->json(['message' => 'form submitted successfully']);
    }

    public function showUsers()
    {
        
    }
}
