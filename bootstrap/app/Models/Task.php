<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'admin_id',
        'manager_id',
        'name',
        'task',
        'description',
        'start_date',
        'end_date',
        'priorty',
        'status',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
