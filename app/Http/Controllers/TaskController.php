<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use App\Models\assign;

class TaskController extends Controller
{
    public function addTask(Request $req)
    {
        
       
        dd($req->all());
        // assign::create($forNewEntry);
        // dd("t");
        
        
       $valid_data = 
       [
        'title' => $req->data->title,
        'description' => $req->data->description,
        'owner' => $req->data->owner,
        'created_at'=> $req->data->created_at,
        'due_date' => $req->data->due_date
       ]; 
    

        $task = task::create($valid_data);


      
        // $assign = new assign();
        // $assign->$req->task_id = $task->id;
        // $assign->$req->user_id = $req->assigned_to;
        // $assign->save();

       dd($req->assigned_to);
       $assign_data =[
        'user_id' => $req->data->assigned_to,
        'task_id' => $task->id
       ];

    //    assign::create($assign_data);

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
