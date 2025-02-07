<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $id;

    public function __construct(request $request)
    {
        $this->id = $request->id;
    }
  

    public function userTasks(){
        $tasks= Task::where('user_id',request()->user()->id)->get();
        $todos = $inprogresses = $backlogs = $completed = [];

        foreach ($tasks as $task) {
            match ($task->status) {
                'To Do'      => $todos[] = $task,
                'Inprogress' => $inprogresses[] = $task,
                'Backlog'    => $backlogs[] = $task,
                'Completed'  => $completed[] = $task,
                default      => null, // If status doesn't match any category
            };
        }
    return response(['ToDo'=>$todos,'Inprogress'=>$inprogresses,'Backlog'=>$backlogs,'Completed'=>$completed]);
}


public function manageruserTasks(){
  $tasks= Task::where('manager_id',request()->user()->id)->get();
  $todos = $inprogresses = $backlogs = $completed = [];

 foreach ($tasks as $task) {
    match ($task->status) {
        'To Do'      => $todos[] = $task,
        'Inprogress' => $inprogresses[] = $task,
        'Backlog'    => $backlogs[] = $task,
        'Completed'  => $completed[] = $task,
        default      => null, 
    };
}
return response([
    'ToDo'=>$todos,
    'Inprogress'=>$inprogresses,
    'Backlog'=>$backlogs,
    'Completed'=>$completed
]);
}
        
 
}
