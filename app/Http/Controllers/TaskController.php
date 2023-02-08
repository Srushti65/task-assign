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


        //    $valid_data =
        //    [
        //     'title' => $req->data['title'],
        //     'description' => $req->data['description'],
        //     'owner' => $req->data['owner'],
        //     'created_at'=> $req->data['created_at'],
        //     'due_date' => $req->data['due_date']
        //    ];

        $n = new task();
        $n->title = $req->data['title'];
        $n->description = $req->data['description'];
        $n->owner_id = $req->data['owner_id'];
        $n->created_at = $req->data['created_at'];
        $n->due_date = $req->data['due_date'];
        $n->assigned_to = $req->data['assigned_to'];
        $n->save();

        // $task = task::create($valid_data);



        // $assign = new assign();
        // $assign->$req->task_id = $task->id;
        // $assign->$req->user_id = $req->assigned_to;
        // $assign->save();


        //    $assign_data =[
        //     'user_id' => $req->data->assigned_to,
        //     'task_id' => $task->id
        //    ];
        //

        //    $newT = new assign();
        //    $newT->user_id = $req->data['assigned_to'];
        //    $newT->task_id = $n->id;

        //    $newT->save();

        //

        //    assign::create($assign_data);

        // return response()->json(['message' => 'task submitted successfully']);
        $n->assigned_to_name = $n->assignedTo->name;
         $n->owner_name = $n->owner->name;
          // $task->assigned_to_name= $task->assignedTo->name;        
          return $n;
        
    }

    public function showTasks()
    {
        // $tasks = task::all();
        // return $tasks;

        
        // $tasks = task::all();

        // // dd($tasks);

        // foreach ($tasks as $task) {
        //     $task->owner_name = $task->owner->name;
        //     $task->assigned_to_name = $task->assignedTo->name;
            
        // }
        // return $tasks;

        $tasks = task::with('owner', 'assignedTo')->get();
        // $tasks=task::all();

        $tasks->map(function ($task){
            $task->owner_name = $task->owner->name;
            $task->assigned_to_name = $task->assignedTo->name;
            $task->assigned_to_id = $task->assignedTo->u_id;    
            return $task;

        });

        return $tasks;
    }

    

    public function updateTask(Request $req, $id)
    {
        $task = Task::find($id);

        $temp = $req->data;
        // dd($temp['title']);
        $task->title = $temp['title'];
        
        $task->description = $temp['description'];
        $task->owner_id = $temp['owner_id'];
        $task->assigned_to = $temp['assigned_to'];
        $task->created_at = $temp['created_at'];
        $task->due_date = $temp['due_date'];
        $task->save();
      
        return $task;
    }

    public function deleteTask(Request $req, $id)
    {
        // dd($req->all());
        $task = Task::find($id);
        $task->delete();

        // return->response()->json(['message' => 'task submitted successfully']);

    }

    Public function viewTask($id)
    {
        $task = task::find($id);
        
        // $task->owner_name = $task->owner->name;
        // $task->assigned_to = $task->assignedTo->name;

        return $task;

    }
}
