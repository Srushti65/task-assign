<?php

namespace App\Http\Controllers;

use App\Models\FormData;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submit(Request $req)
    {

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
