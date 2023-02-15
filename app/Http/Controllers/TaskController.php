<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use App\Models\assign;
use App\Models\FormData;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewTaskNotification;
use App\Notifications\taskCompletedNotification;

class TaskController extends Controller
{
    public function addTask(Request $req)
    {
        // dd($req->data);
        $validated = $req->validate([
            'data.title' => 'required|string|max:255|min:3',
            'data.description' => 'required|max:555|min:3',
            'data.owner_id' => 'required',
            'data.created_at' => 'required|after_or_equal:today',
            'data.due_date' => 'required|after_or_equal:today',
            'data.assigned_to' => 'required',
        ]);



        $n = new task();
        $n->title = $req->data['title'];
        $n->description = $req->data['description'];
        $n->owner_id = $req->data['owner_id'];
        $n->created_at = $req->data['created_at'];
        $n->due_date = $req->data['due_date'];
        $n->assigned_to = $req->data['assigned_to'];
        $n->save();
        $n->assigned_to_name = $n->assignedTo->name;
        $n->owner_name = $n->owner->name;

        // $n->sendNewTaskNotification($n->assigned_to);
        $user = FormData::find($n->assigned_to);
        Notification::send($user, new NewTaskNotification($n) );

        return $n;
    }

    public function showTasks()
    {
        $tasks = task::with('owner', 'assignedTo')->get();

        $tasks->map(function ($task) {
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

        $task->title = $temp['title'];

        $task->description = $temp['description'];
        $task->owner_id = $temp['owner_id'];
        $task->assigned_to = $temp['assigned_to_id'];
        $task->created_at = $temp['created_at'];
        $task->due_date = $temp['due_date'];
        $task->save();

        return $task;
    }

    public function deleteTask(Request $req, $id)
    {
        $task = Task::find($id);
        $task->delete();

        return response()->json(['message' => 'task deleted successfully']);
    }

    public function viewTask($id)
    {
        $task = task::find($id);

        $task->owner_name = $task->owner->name;
        $task->assigned_to = $task->assignedTo->name;

        return $task;
    }

    public function completeTask(Request $req, $id)
    {
        // dd($req->data);
        $task = Task::find($id);
        $task->is_completed = 1;

        $task->save();
        //wrie this function logic here 
        $task->taskIsCompletedNotification($task->owner_id);

        return response()->json(['message' => 'task completed successfully']);
    }
}
