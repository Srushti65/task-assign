<?php

namespace App\Models;

use App\Models\task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FormData extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email'];

    public $timestamps = false;
    protected $primaryKey = 'u_id';

    public function task()
    {
        return $this->hasMany('App\Models\task');
    }
}
