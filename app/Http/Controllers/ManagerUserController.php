<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;

class ManagerUserController extends Controller
{

    public function managerUser(){
        $id=request()->user();
        $name=$id->name;
        $user = User::select('id', 'name', 'email','role','manager')->where('manager', $name)->get();
   
        return DataTables::of($user)
        ->addColumn('action', function ($user) {
           return "<button type='submit' class='btn btn-default taskview-button' data-id={$user->id} data-toggle='modal' data-target='#modal-viewtask'>View-task</button>";})
            ->make(true);
    }

    public function addid(){
        $id=request()->id;
        $user=User::select('id')->where('id',$id)->get();
        return $user;
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
          $admin_id=User::select('admin_id')->where('name',$name)->value('admin_id');
          $task['user_id']=$user_id;
          $task['admin_id']=$admin_id;
        Task::create($task);
        return redirect('manager-dashboard');
    }

    public function gettask(){
        $task=Task::select('id','name','task','end_date','status')->where('manager_id',request()->user()->id)->get();
        return DataTables::of($task)->addColumn('action', function ($task) {
            return "<button type='submit' class='btn btn-default edit-button' data-id={$task->id} data-toggle='modal'>Edit</button>
                     <button type='submit' class='btn btn-default delete-button' data-id={$task->id} data-toggle='modal' data-target='#delete-user'>Delete</button>";
             })->make(true);
    }


    public function taskeditDetails(){
        $id=request()->id;
        $task=Task::select('id','name','task','priorty','end_date','status','description')->where('id',$id)->get();
        return $task;
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
          
          return view('manager.manager-dashboard');
      }


      public function editTaskProgress(){
        $validated=request()->all();
        
        $validated = collect($validated)
        ->reject(function ($value, $key) {
         return $value === null || $key === '_token';
         })
        ->toArray();

        Task::where('id',$validated['id']
        )->update($validated);
  
          return redirect()->back();
      }

      public function destroy()
    {
        $id=request()->id;
        Task::where('id',$id)->delete();

        return 'User Deleted Successfully';
    }

    public function getusername(){
        $names=User::select('name')->where('manager',request()->user()->name)->get();
        return response($names);
      } 

      public function getUsers(){
        $user=request()->user();
        $name=$user->name;
        $user = User::select('id', 'name', 'email','role')->where('manager', $name)->get();
   
        return DataTables::of($user)
        ->addColumn('action', function ($user) {
           return "<button type='submit' class='btn btn-default edit-button' data-id={$user->id} data-toggle='modal' data-target='#modal-default'>Edit</button>";
            })
            ->make(true);
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
  
          return view('manager.manage-usercontrol');
      }

      public function manageusercontrol(){
        return view('manager.manage-usercontrol');
      }

      public function managerdashboard(){
        if(Auth::user()->role=='manager'){
            return view('manager.manager-dashboard');}
            else{
                abort(403);
            }
      }

      public function managertask(){
            if(Auth::user()->role=='manager'){
        return view('manager.task');}
        else{
            abort(403);
        }
      }
}
