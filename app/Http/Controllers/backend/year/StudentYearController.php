<?php

namespace App\Http\Controllers\backend\year;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;
use Symfony\Contracts\Service\Attribute\Required;

class StudentYearController extends Controller
{
    //
    public function ViewYear(){
        $years=StudentYear::all();

        return view('backend.year.student_year',compact('years'));

    }
    public function AddYear(){
        return view('backend.year.add_student_year');
    }
    public function StoreYear(Request $request){
        $ValidatedData=$request->validate([
            'name'=>'required | unique:student_years,name'
        ]);
        $data= new StudentYear();
        $data->name=$request->name;
        $data->save();
        $notification =array(
            'message'=>'Student Year Inserted Successfully',
            'alert-type'=>'success'

        );

        return redirect()->route('student.year.view')->with($notification);
    }
    public function EditYear(Request $request,$id){
        $data=StudentYear::find($id);

        return view('backend.year.edit_student_year',compact('data'));
        
    }
    public function UpdateYear(Request $request , $id){
        $data=StudentYear::find($id);
        $ValidatedData=$request->validate([
            'name'=>'required | unique:student_years,name'.$data->id

        ]);
        $data->name=$request->name;
        $data->Save();
        $notification = array(
            'message'=>'Student Year Updated Succcessfullly',
            'alert-type'=>'success'

        );

        return  redirect()->route('student.year.view')->with($notification);
    }
    public function DeleteYear(Request $request,$id){
        $data=StudentYear::find($id);
        $data->delete();

        $notification= array([
            'message'=>'Student Year Deleted Successfully',
            'alert-type'=>'info'

        ]);
        return redirect()->route('student.year.view')->with($notification);
    }
}
