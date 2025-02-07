<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;

use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Models\job;
use App\Models\User;
use App\Mail\JobPosted;


Route::get('test',function(){
    $job=job::first();
    \App\Jobs\TranslateJob::dispatch($job);
    return 'done';
});

Route::controller(JobController::class)->group(function(){
    Route::get('/',[JobController::class,'home']);


//about page
Route::get('/about',[JobController::class,'about']);

Route::get('/jobs',[JobController::class,'jobs']);

Route::get('/job/{job}', [JobController::class,'show']);
});



//contact page
Route::get('/contact', function () {
    return view('contact');
});



//create job
Route::get('/jobs/create',function(){
    return view('jobs/create');
});

//move to database jobs
Route::post('/jobs',function(){
    request()->validate(
        ['username'=>['required','min:3'],'title'=>['required']]
    );
    $job=job::create(['name'=>request('username'),'title'=>request('title'),'employer_id'=>1]);
    Mail::to($job->employer->user)->queue(new \App\Mail\JobPosted($job));
    return redirect('/jobs');
});

//edit job
Route::get('/jobs/{job}/edit', function ( Job $job) {


    Gate::authorize('edit',$job);
    return view('jobs/edit',['job'=>$job]);
})->middleware('auth')
  ->can('edit','job');

//update
Route::patch('/job/{id}',function($id){
    request()->validate(
        ['username'=>['required','min:3'],'title'=>['required']]
    );
    $job=job::findOrFail($id);
    $job->update(['name'=>request('username'),'title'=>request('title'),'employer_id'=>1]);
    return redirect('/job/'.$job->id);
});

//delete
Route::delete('/job/{id}',function($id){
    
    $job=job::findOrFail($id);
    Gate::authorize('edit',$job);
    $job->delete();
    return redirect('/jobs');
});



Route::get('/register',[RegisteredUserController::class,'create']);

Route::post('/register',[RegisteredUserController::class,'store'])->middleware('auth');

Route::get('/login',[SessionController::class,'create']);

Route::post('/login',[SessionController::class,'store']);

Route::post('/logout',[SessionController::class,'destroy']);