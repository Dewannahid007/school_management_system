<?php

use App\Http\Controllers\AdminController;
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

