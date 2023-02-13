<?php

namespace App\Http\Controllers;

use App\Models\FormData;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submit(Request $req)
    {

        $validated = $req->validate([
            'data.name' => 'required|string|max:255|min:3',
            'data.email' => 'required|email|unique:form_data,email',
        ]);

        $temp = $req->data;
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
