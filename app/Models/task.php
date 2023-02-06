<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'owner','created_at', 'due_date'];

    public $timestamps = false;

    public function FormData()  
    {  
        return $this->hasOne('App\Models\FormData');  
    } 
}
