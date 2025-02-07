<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class AdminUserController extends Controller
{


    public function manageuser(){
        if(Auth::user()->role=='admin'){
            return view('admin.manage-user');}
            else{
                abort(403);
            }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=request()->validate(['name'=>['required'],
        'email'=>['required','email'],
        'role'=>['required'],
        'password'=>['required','confirmed',Password::min(6)->letters()->numbers()],
        'manager'=>[''],
        'admin_id'=>['required'],
        ]);
        User::create($validated);

        return view('admin.manage-user');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function deleteuser(){
        $id=request()->id;
        User::where('id',$id)->delete();

        return 'User Deleted Successfully';
    }


    public function getUser(){
        $id=request()->user();
        $admin_id=$id->id;
        $user = User::select('id', 'name', 'email','role','manager')->where('admin_id', $admin_id)->get();
   
        return DataTables::of($user)
        ->addColumn('action', function ($user) {
           return "<button type='submit' class='btn btn-default edit-button' data-id={$user->id} data-toggle='modal' data-target='#modal-default'>Edit</button>
                    <button type='submit' class='btn btn-default delete-button' data-id={$user->id} data-toggle='modal' data-target='#delete-user'>Delete</button>";
            })
            ->make(true);
    }

    public function editDetails(){
        $id=request()->id;
        $user=User::select('id','name','email','role','manager')->where('id',$id)->get();
        return $user;
    }

    public function editdashboardDetails(){
        $id=Auth::user()->id;
        $user=User::select('id','name','email','role','manager')->where('id',$id)->get();
        return $user;
    }

    public function editUser(){
      $validated=request()->all();

        $validated = collect($validated)->reject(function ($value, $key) {
            return $value === null || $key === '_token';
        })->map(function ($value, $key) {
            if ($value !== null && in_array($key, ['password', 'password_confirmation']) ) {
                return password_hash($value, PASSWORD_BCRYPT);
            }
            return $value;
        })->toArray();
        
        User::where('id',$validated['id']
        )->update($validated);

        return view('admin.manage-user');
    }
    public function editUserdetails( request $data){
        $validated=$data;
       
        $validated = collect($validated)->reject(function ($value, $key) {
            return $value === null || $key === '_token';
        })->map(function ($value, $key) {
            if ($value !== null && in_array($key, ['password', 'password_confirmation']) ) {
                return password_hash($value, PASSWORD_BCRYPT);
            }
            return $value;
        })->toArray();
       
          User::where('id',$validated['id']
          )->update($validated);

          return view('dashboard');
      }

    public function admingettask(){
        $task=Task::select('id','name','task','end_date','status')->where('admin_id',request()->user()->id)->get();
        return DataTables::of($task)->addColumn('action', function ($task) {
            return "<button type='submit' class='btn btn-default edit-button' data-id={$task->id} data-toggle='modal' data-target='#modal-edit-user'>Edit</button>
                     <button type='submit' class='btn btn-default delete-button' data-id={$task->id} data-toggle='modal' data-target='#delete-user'>Delete</button>";
             })->make(true);
    }

    public function getusername(){
        $names=User::select('name')->where('role','user')->get();
        return response($names);
      } 

      public function getmanagername(){
        $names=User::select('name')->where('role','manager')->get();
        return response($names);
      } 

      public function addtask(){
        $task=request()->all();
        foreach($task as $key=>$value){
            if($key=="_token"){
                unset($task[$key]);
            }
          }
          $name=$task['name'];
          $user_id=User::select('id')->where('name',$name)->value('id');
          $managername=User::select('manager')->where('name',$name)->value('manager');
          $manager_id=User::select('id')->where('name',$managername)->value('id');
          $task['user_id']=$user_id;
          $task['manager_id']=$manager_id;
          $tsk['admin_id']=Auth::user()->id;
        Task::create($task);
        return redirect('manage-task');
    }

    public function editTask(){
        $validated=request()->all();
       
          $validated = collect($validated)
            ->reject(function ($value, $key) {
             return $value === null || $key === '_token';
             })
            ->toArray();
          
          Task::where('id',$validated['id']
          )->update($validated);
  
          return view('admin.manage-task');
      }
}



