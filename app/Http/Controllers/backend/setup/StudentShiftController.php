<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    //
    public function ViewShift(){
        $records=StudentShift::all();

        return view('backend.shift.student_shift_view',compact('records'));

    }
    public function AddShift(){
        return view('backend.shift.student_shift_add');

    }
    public function StoreShift(Request $request){
        $validated = $request->validate([

            'name'=>'required | unique:student_shifts,name'
        ]);
        
        $data= new StudentShift();
        $data->name=$request->name;
        $data->save();
        
        $notification =array(
            'message'=>'Student Shift Inserted',
            'alert-type'=>'info'

        );
        return redirect()->route('student.shift.view')->with($notification);

    }
    public function EditShift(Request $request ,$id){
        $data=StudentShift::find($id);

        return view('backend.shift.student_shift_edit',compact('data'));

    }
    public function UpdateShift(Request $request,$id){
        $data=StudentShift::find($id);
        $validatedData=$request->validate([
            'name'=>'required|unique:student_shifts,name,'.$data->id

        ]);
        $data->name=$request->name;
        $data->save();
        $notification =array(
            'message'=>'Student Shift Updated Successfully',
            'alert-type'=>'info'

        );
        return redirect()->route('student.shift.view')->with($notification);
    }
    public function DeleteShift(Request $request ,$id){
        $ShiftDelete=StudentShift::find($id);
        $ShiftDelete->delete();

        $notification =array(
            'message'=>'Student Class Deleted Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('student.shift.view')->with($notification);
        
    }
}
