<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;

class TaskController extends Controller
{
    public function addTask(Request $req)
    {

       $valid_data = [
        'title' => $req->title,
        'description' => $req->description,
        'created_at'=> $req->created_at,
        'due_date' => $req->due_date
       ];

        task::create($valid_data);

       

        return response()->json(['message' => 'task submitted successfully']);
    }
}
