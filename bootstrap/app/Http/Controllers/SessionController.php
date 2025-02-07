<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboardusername()
    {
        $name=Auth::user()->name;
        return($name);
    }

    public function dashboarduserid()
    {
        $id=Auth::user()->id;
        return($id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated=request()->validate(['email'=>['required','email'],
                         'password'=>['required']]);

         if(Auth::attempt($validated)){
          request()->session()->regenerate();
          if(Auth::user()->role=='admin'){return redirect('manage-user');}
          else if(Auth::user()->role=='manager'){return redirect('manager-dashboard');}
          else if(Auth::user()->role=='user'){return redirect('userTask');}
          else{abort(403);}
          }
          else{
            throw ValidationException::withMessages(['email'=>'Sorry, those credentials doesnot match.']);
          }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }

    public function dashboard(){
        return view('dashboard');
    }
}
