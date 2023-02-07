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
        $tasks = task::all();

        // dd($tasks);

        foreach ($tasks as $task) {
            // dd($task->owner);
            // $task->owner_id;
            // dd($task->owner->name);
            // dd($task->owner->name);
            $task->owner_name = $task->owner->name;

            //for assigned_to
            // $tid = $task->t_id;
            // $taskRow = $task->assignedTo;
            // dd($taskRow);

            $task->assigned_to_name = $task->assignedTo->name;
            // dd($task);

        }
        return $tasks;
        // $tasks = task::first();
        // dd($tasks->owner);

        // $task = [

        //     'title' => 'asjnak',
        //     'description' => 'akjsdahsj'
        // ];

        // $task['c'] = c;
        // $task->c = c;



        $uTask = task::find(1);
        $owner = $uTask->owner;
        $owner_name = $owner->name;
    }

    public function updateTask(Request $req)
    {
    }

    public function deleteTask(Request $req, $id)
    {
        // dd($req->all());
        $task = Task::find($id);
        $task->delete();

        // return->response()->json(['message' => 'task submitted successfully']);

    }
}
