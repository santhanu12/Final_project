<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


use App\Http\Controllers\ManagerUserController;




Route::middleware(['guest.redirect'])->group(function () {  
Route::get('/',[SessionController::class,'create'])->name('login');
Route::post('/login',[SessionController::class,'store']);
});
Route::post('/logout',[SessionController::class,'destroy']);
//user board
Route::get('/userTask',[RegisteredUserController::class,'userTask']);

Route::get('/forgetpassword', [RegisteredUserController::class,'forgetpassword']);

Route::post('/forgetpassword',[RegisteredUserController::class,'forgetpasswordmail']);

Route::post('/edit-password',[RegisteredUserController::class,'editpassword']);

Route::get('/edit-password',[RegisteredUserController::class,'editpasswordget']);
Route::post('/register',[RegisteredUserController::class,'store']);
Route::get('/register',[RegisteredUserController::class,'create']);


Route::get('/dashboard',[SessionController::class,'dashboard'])->middleware('auth');

//Admin
Route::post('/add-user',[AdminUserController::class,'store']);

Route::get('/manage-user',[AdminUserController::class,'manageuser']);

Route::get('/manage-task',function(){
    return view('admin.manage-task');
});
//Admin-datatable filler
Route::post('getuser', [AdminUserController::class,'getUser'])->name('getUserdetails');
//Manger user details
Route::post('getuserdetails', [ManagerUserController::class,'getUsers'])->name('getmanagerUserdetails');

//manager-datatable filler
Route::post('get-user', [ManagerUserController::class,'managerUser'])->name('getmanagerUsers');
//task-datatable filler
Route::post('get-task', [ManagerUserController::class,'gettask'])->name('getTasks');
//admin-datatable filler
Route::post('adminget-task', [AdminUserController::class,'admingettask'])->name('admingetTasks');
//Admin edit details
Route::post('edit-details',[AdminUserController::class,'editDetails'])->name('editDetails');
Route::post('edit-dashboard-details',[AdminUserController::class,'editdashboardDetails'])->name('editdashboardDetails');
Route::get('delete-user',[AdminUserController::class,'deleteuser'])->name('deleteuser');

//Manager edit details
Route::post('add-id',[ManagerUserController::class,'addid'])->name('addid');
Route::post('/add-task',[ManagerUserController::class,'addtask']);
//admin adding task
Route::post('/adminadd-task',[AdminUserController::class,'addtask']);
//task edit details
Route::post('task-details',[ManagerUserController::class,'taskeditDetails'])->name('taskeditDetails');

Route::post('edit-user',[AdminUserController::class,'editUser']);
Route::post('edit-manager-user',[ManagerUserController::class,'editUser']);
Route::post('edit-user-details',[AdminUserController::class,'editUserdetails']);


Route::get('/manage-usercontrol',[ManagerUserController::class,'manageusercontrol']);
/* Manager-Controls*/
Route::get('/manager-dashboard',[ManagerUserController::class,'managerdashboard']);
Route::get('/usertask',[ManagerUserController::class,'managertask']);

Route::post('/edit-task',[ManagerUserController::class,'editTask']);
Route::post('/adminedit-task',[AdminUserController::class,'editTask']);
Route::post('deletetaskDetails',[ManagerUserController::class,'destroy'])->name('deletetaskDetails');
Route::post('/edit-task-progress',[ManagerUserController::class,'editTaskProgress']);

//taskloader
Route::post('taskLoader', [TaskController::class,'userTasks'])->name('taskLoader');
Route::post('managertaskLoader', [TaskController::class,'manageruserTasks'])->name('managertaskLoader');
Route::post('getusername', [ManagerUserController::class,'getusername'])->name('getusername');

//adminoption user name
Route::post('admingetusername', [AdminUserController::class,'getusername'])->name('admingetusername');

//adminoption manager name
Route::post('admingetmanagername', [AdminUserController::class,'getmanagername'])->name('admingetmanagername');
Route::post('dashboardusername', [SessionController::class,'dashboardusername'])->name('dashboardusername');
Route::post('dashboarduserid', [SessionController::class,'dashboarduserid'])->name('dashboarduserid');

