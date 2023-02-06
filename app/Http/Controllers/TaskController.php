<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use App\Models\assign;

class TaskController extends Controller
{
    public function addTask(Request $req)
    {
        
       
        // dd($req->all());
        // assign::create($forNewEntry);
        // dd("t");
       $valid_data = 
       [
        'title' => $req->title,
        'description' => $req->description,
        'owner' => $req->owner,
        'assigned_to'=>$req->assigned_to,
        'created_at'=> $req->created_at,
        'due_date' => $req->due_date
       ];

        $task = task::create($valid_data);


      
        // $assign = new assign();
        // $assign->task_id = $task->id;
        // $assign->user_id = $req->assigned_to;
        // $assign->save();

        return response()->json(['message' => 'task submitted successfully']);
    }

    public function showTasks()
    {
        $tasks = task::all();

        // $ownerName = FormData::find(task->owner)->name;

        // foreach ($tasks){

        //     $ownerName = FormData::find(task->owner)->name;
        //     $tasks->owner = $ownerName;

        // }
        return $tasks;
    }
}
