<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\task;

class assign extends Model
{
    use HasFactory;

    protected $fillable = ['id','task_id','user_id'];

    public $timestamps = false;

    public function getTask()
    {
        return $this->hasOne(task::class, 'task_id', 't_id');
    }

    public function getUser()
    {
        return $this->hasMany(FormData::class, 'user_id', 'u_id');
    }

}
