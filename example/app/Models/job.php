<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Support\Arr;
use \Illuminate\Database\Eloquent\Model;
class job extends Model{
    use HasFactory;
    protected $table='job_listings';
    protected $fillable=['employer_id','title','name'];

    public function Employer(){
        return $this->belongsTo(Employer::class);
    }

    public function Tag(){
        return $this->belongsToMany(Tag::class,foreignPivotKey:'job_listings_id');
    }
}