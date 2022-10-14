<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\setup\StudentClassController;
use App\Http\Controllers\backend\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});
route::get('/admin/logout',[AdminController::class,'logout'])->name('admin.logout');
// User management all routes
Route::prefix('users')->group(function(){
    route::get('/view',[UserController::class,'UserView'])->name('user.view');
    route::get('/add',[UserController::class,'UserAdd'])->name('users.add');
    route::post('/store',[UserController::class,'UserStore'])->name('users.store');
    route::get('/edit/{id}',[UserController::class,'UserEdit'])->name('users.edit');
    route::post('/update/{id}',[UserController::class,'UserUpdate'])->name('users.update');
    route::get('/delete/{id}',[UserController::class,'UserDelete'])->name('users.delete');

});
Route::prefix('profile')->group(function(){
    route::get('/view',[ProfileController::class,'ProfileView'])->name('profile.view');
    route::get('/edit',[ProfileController::class,'ProfileEdit'])->name('profile.edit');
    route::post('/store',[ProfileController::class,'ProfileStore'])->name('profile.store');
    route::get('/password/view',[ProfileController::class,'PasswordView'])->name('password.view');
    route::post('/password/update',[ProfileController::class,'PasswordUpdate'])->name('password.update'); 

});

Route::prefix('setups')->group(function(){
    route::get('/student/class/view',[StudentClassController::class,'ViewStudent'])->name('student.class.view');
    route::get('/student/class/add',[StudentClassController::class,'AddClass'])->name('student.class.add');
    route::post('/student/class/store',[StudentClassController::class,'StoreClass'])->name('student.class.store');
    route::get('/student/class/delete/{id}',[StudentClassController::class,'DeleteClass'])->name('student.class.delete');
    route::get('/student/class/edit/{id}',[StudentClassController::class,'EditClass'])->name('student.class.edit'); 
    route::post('student/class/update/{id}',[StudentClassController::class,'UpdateClass'])->name('student.class.update');


});

