<?php

namespace App\Http\Controllers;

use App\Models\job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function home(){
        return view('home');
    }

    public function about(){
        return view('about');
    }
    
    public function jobs(){
        $jobs=job::with('Employer')->latest()->simplePaginate(3);
    return view('jobs/index',['jobs'=>$jobs]);
    }

    public function show(Job $job){
        return view('jobs/show',['job'=>$job]);
    }
}
