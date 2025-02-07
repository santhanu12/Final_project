<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Jobs\DeliverEmail;

class RegisteredUserController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=request()->validate(['name'=>['required'],
        'email'=>['required','email'],
        'role'=>['required'],
        'password'=>['required','confirmed',
        Password::min(6)->letters()->numbers()]
        ]);
        $user=User::create($validated);
        return redirect('/');
    }

    public function userTask(){
        return view('userTask');
    }

    public function forgetpassword(){
        return view('passwordresetting.forgetpassword');
    }

    public function forgetpasswordmail(){
        
        request()->validate(['email'=>['required']]);
        $email=request()->email;
       if( $Tosend=User::where('email',$email)->pluck('email')->first()){
        DeliverEmail::dispatch($Tosend);
        
    
        return "Mail has been sent to you with the password change link.";}
        else{
            return "The given mail is not registered please register";
        }
    }

    public function editpassword(){
        request()->validate(['password'=>['required','confirmed'],
        'email'=>['required','email']]);
        $password=request()->password;
        $hashpassword=password_hash($password,PASSWORD_BCRYPT);
        $email=request()->email;
        User::where('email',$email)->update(array('password'=>$hashpassword));
        return view('auth.login');
    }

    public function editpasswordget(){
        return view('passwordresetting.edit-password');

    }
}
