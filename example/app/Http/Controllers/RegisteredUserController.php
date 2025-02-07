<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
  
class   RegisteredUserController extends Controller
{
    public function create(){
       
        return view('auth.register');
    }

    public function store(){
        //validate
       
        $validateatb=request()->validate([
            'name'=>['required'],
            'email'=>['required','email'],
            'password'=>['required','min:8','confirmed'],
        ]);
        //create the user
       $user=User::create($validateatb);
       
        //login
        Auth::login($user);
        //redirect
        return redirect('/jobs');
    }
}
