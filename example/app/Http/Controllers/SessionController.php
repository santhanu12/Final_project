<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(){
        $attributes=request()->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);
        if(!Auth::attempt($attributes)){
           throw ValidationException:: withMessages(['email'=>"Credintials does not match."]);

        }
        return redirect('/jobs');
        //regenerate the session token
        request()->session()->regenerate();

    }
    public function destroy(){
        Auth::logout();
        return redirect('/');
    }
}
