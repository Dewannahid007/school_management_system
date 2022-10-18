<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\setup\AssignSubjectController;
use App\Http\Controllers\backend\setup\ExamTypeController;
use App\Http\Controllers\backend\setup\FeeAmountController;
use App\Http\Controllers\backend\setup\FeeCategoryController;
use App\Http\Controllers\backend\setup\SchoolSubjectController;
use App\Http\Controllers\backend\setup\StudentClassController;
use App\Http\Controllers\backend\setup\StudentGroupController;
use App\Http\Controllers\backend\setup\StudentShiftController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\year\StudentYearController;
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


    route::get('/student/year/view',[StudentYearController::class,'ViewYear'])->name('student.year.view');
    route::get('/student/year/add',[StudentYearController::class,'AddYear'])->name(('student.year.add'));
    route::post('/student/year/store',[StudentYearController::class,'StoreYear'])->name('student.year.store');
    route::get('/student/year/edit{id}',[StudentYearController::class,'EditYear'])->name('student.year.edit');
    route::post('/student/year/update/{id}',[StudentYearController::class,'UpdateYear'])->name('student.year.update');
    route::get('/student/year/delete/{id}',[StudentYearController::class,'DeleteYear'])->name('student.year.delete');


    route::get('/student/group/view',[StudentGroupController::class,'ViewGroup'])->name('student.group.view');
    route::get('/student/group/add',[StudentGroupController::class,'AddGroup'])->name('student.group.add');
    route::post('/student/group/store',[StudentGroupController::class,'StoreGroup'])->name('student.group.store');
    route::get('/student/group/edit/{id}',[StudentGroupController::class,'EditGroup'])->name('student.group.edit');
    route::post('/student/group/update/{id}',[StudentGroupController::class,'UpdateGroup'])->name('student.group.update');
    route::get('/student/group/delete/{id}',[StudentGroupController::class,'DeleteGroup'])->name('student.group.delete');

    route::get('/student/shift/view',[StudentShiftController::class,'ViewShift'])->name('student.shift.view');
    route::get('/student/shift/add',[StudentShiftController::class,'AddShift'])->name('student.shift.add');
    route::post('/student/shift/store',[StudentShiftController::class,'StoreShift'])->name('student.shift.store');
    route::get('/student/shift/edit/{id}',[StudentShiftController::class,'EditShift'])->name('student.shift.edit');
    route::post('/student/shift/update/{id}',[StudentShiftController::class,'UpdateShift'])->name('student.shift.update');
    route::get('/student/shift/delete/{id}',[StudentShiftController::class,'DeleteShift'])->name('student.shift.delete');

    route::get('/fee/category/view',[FeeCategoryController::class,'ViewFeeCategory'])->name('fee.category.view');
    route::get('/fee/category/add',[FeeCategoryController::class,'AddFeeCategory'])->name('fee.category.add');
    route::post('/fee/category/store',[FeeCategoryController::class,'StoreFeeCategory'])->name('fee.category.store');
    route::get('/fee/category/edit/{id}',[FeeCategoryController::class,'EditFeeCategory'])->name('fee.category.edit');
    route::post('/fee/category/update/{id}',[FeeCategoryController::class,'UpdateFeeCategory'])->name('fee.category.update');
    route::get('/fee/category/delete/{id}',[FeeCategoryController::class,'DeleteFeeCategory'])->name('fee.category.delete');

    route::get('/fee/amount/view',[FeeAmountController::class,'ViewFeeAmount'])->name('fee.amount.view');
    route::get('fee/amount/add',[FeeAmountController::class,'AddFeeAmount'])->name('fee.amount.add');
    route::post('fee/amount/store',[FeeAmountController::class,'StoreFeeAmount'])->name('fee.amount.store');
    route::get('fee/amount/edit/{fee_category_id}',[FeeAmountController::class,'EditFeeAmount'])->name('fee.amount.edit');
    route::post('fee/amount/update/{fee_category_id}',[FeeAmountController::class,'UpdateFeeAmount'])->name('fee.amount.update');
    route::get('fee/amount/details/{fee_category_id}',[FeeAmountController::class,'DetailsFeeAmount'])->name('fee.amount.details');


    route::get('exam/type/view',[ExamTypeController::class,'ExamType'])->name('exam.type.view');
    route::get('exam/type/add',[ExamTypeController::class,'AddExamType'])->name('exam.type.add');
    route::post('exam/type/store',[ExamTypeController::class,'StoreExamType'])->name('exam.type.store');
    route::get('exam/type/edit/{id}',[ExamTypeController::class,'EditExamType'])->name('exam.type.edit');
    route::post('exam/type/update/{id}',[ExamTypeController::class,'UpdateExamType'])->name('exam.type.update');
    route::get('exam/type/delete/{id}',[ExamTypeController::class,'DeleteExamType'])->name('exam.type.delete');


    route::get('school/subject/view',[SchoolSubjectController::class,'SchoolSubject'])->name('school.subject.view');
    route::get('school/subject/add',[SchoolSubjectController::class,'AddSchoolSubject'])->name('school.subject.add');
    route::post('school/subject/store',[SchoolSubjectController::class,'StoreSchoolSubject'])->name('school.subject.store');
    route::get('school/subject/edit/{id}',[SchoolSubjectController::class,'EditSchoolSubject'])->name('school.subject.edit');
    route::post('school/subject/update/{id}',[SchoolSubjectController::class,'UpdateSchoolSubject'])->name('school.subject.update');
    route::get('school/subject/delete/{id}',[SchoolSubjectController::class,'DeleteSchoolSubject'])->name('school.subject.delete');


    route::get('assign/subject/view',[AssignSubjectController::class,'ViewAssignSubject'])->name('assign.subject.view');
    route::get('assign/subject/add',[AssignSubjectController::class,'AddAssignSubject'])->name('assign.subject.add');
    route::post('assign/subject/store',[AssignSubjectController::class,'StoreAssignSubject'])->name('assign.subject.store');
    route::get('assign/subject/edit/{class_id}',[AssignSubjectController::class,'EditAssignSubject'])->name('assign.subject.edit');
    route::post('assign/subject/update/{class_id}',[AssignSubjectController::class,'UpdateAssignSubject'])->name('assign.subject.update');
    route::get('assign/subject/details/{class_id}',[AssignSubjectController::class,'DetailsAssignSubject'])->name('assign.subject.details');





    



  




});