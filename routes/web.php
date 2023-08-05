<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Models\Permission;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::get("dashboard", [DashboardController::class,'show']);
    Route::get("admin", [DashboardController::class,'show']);
    Route::get("admin/users/list", [AdminUsersController::class,'list'])->name('user.list')->can('user.view');
    Route::get("admin/users/add", [AdminUsersController::class,'add'])->can('user.add');
    Route::post("admin/users/store", [AdminUsersController::class,'store'])->can('user.add');

    Route::get("admin/users/delete/{id}",[AdminUsersController::class,'delete'])->name('delete_user')->can('user.delete');
    Route::get("admin/users/action",[AdminUsersController::class,'action']);

    Route::get("admin/users/edit/{user}",[AdminUsersController::class,'edit'])->name('edit_user')->can('user.update');
    Route::post("admin/users/update/{user}",[AdminUsersController::class,'update'])->name('update.user')->can('user.update');
});

#Phân quyền
Route::group(['prefix'=>'admin','middleware'=>['auth']],function(){
    Route::get("/permission/add",[PermissionController::class,'add'])->name('permission.add')->can('role.add');
    Route::post("/permission/store",[PermissionController::class,'store'])->name('permission.store')->can('role.add');
    Route::get("/permission/edit/{id}",[PermissionController::class,'edit'])->name('permission.edit')->can('role.update');
    Route::post("/permission/update/{id}",[PermissionController::class,'update'])->name('permission.update')->can('role.update');
    Route::get("/permission/delete/{id}",[PermissionController::class,'delete'])->name('permission.delete')->can('role.delete');

    #route role
    Route::get("/role",[RoleController::class,'index'])->name("role.index")->can('role.view');
    Route::get("/role/add",[RoleController::class,'add'])->name("role.add")->can('role.add');
    Route::post("/role/store",[RoleController::class,'store'])->name("role.store")->can('role.add');

    Route::get("/role/edit/{role}",[RoleController::class,'edit'])->name("role.edit")->can('role.update');
    Route::post("/role/update/{role}",[RoleController::class,'update'])->name("role.update")->can('role.update');
    
    Route::get("/role/delete/{role}",[RoleController::class,'delete'])->name("role.delete")->can('role.delete');

});
