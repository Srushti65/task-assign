<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assign extends Model
{
    use HasFactory;

    protected $fillable = ['id','task_id','user_id'];

    public $timestamps = false;

}
