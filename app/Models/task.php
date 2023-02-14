<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Notification;
use App\Models\FormData;
use App\Notifications\newTaskNotification;
use App\Notifications\taskCompletedNotification;

class task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'owner_id', 'assigned_to', 'created_at', 'due_date'];

    public $timestamps = false;

    protected $primaryKey = 't_id';
    protected $guarded = [];

    // public function FormData()
    // {
    //     return $this->hasOne('App\Models\FormData');
    // }

    //to get owner from user data
    public function owner()
    {
        return $this->belongsTo(FormData::class, 'owner_id', 'u_id');
    }

    //to get assignee from user data
    public function assignedTo()
    {
        return $this->belongsTo(FormData::class, 'assigned_to', 'u_id');
    }

    // id = assignedtoid
    public function sendNewTaskNotification($id)
    {
        $user = FormData::find($id);
        //you are supposed to add here somthinggggg
        $user->notify(new newTaskNotification($this));
        // Notification::send($user, new newTaskNotification($this) );

    }

    // id = owner_id
    public function taskIsCompletedNotification($id)
    {
        //find the object of owner
        $user = FormData::find($id);

        $user->notify(new taskCompletedNotification($this));

        return $this->completed;
    }
}
