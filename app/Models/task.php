<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormData;

class task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'owner_id', 'assigned_to','created_at', 'due_date', 'is_deleted'];

    public $timestamps = false;

    // public function FormData()  
    // {  
    //     return $this->hasOne('App\Models\FormData');  
    // } 
    public function owner()
    {
        return $this->belongsTo(FormData::class, 'owner_id', 'u_id');
    }
}
