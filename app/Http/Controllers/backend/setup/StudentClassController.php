<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Contracts\Service\Attribute\Required;

class StudentClassController extends Controller
{
    //
    public function ViewStudent(){
        $students=StudentClass::all();

        return view('backend.setup.student_class',compact('students'));

    }
    public function AddClass(){
        return view('backend.setup.add_student_class');

    }
    public function StoreClass(Request $request){
        $validatedData=$request->validate([
            'name'=>'required || unique:student_classes,name'

        ]);

        $data = new StudentClass();
        $data->name=$request->name;
        $data->save();

        $notification = array(
            'message'=>'Class Inserted Successfully',
            'alert-type'=>'success'

        );

        return redirect()->route('student.class.view')->with($notification);

    }
    public function DeleteClass(Request $request,$id){

        $student_class=StudentClass::find($id);
        $student_class->delete();

        return redirect()->route('student.class.view');
    }
    public function EditClass(Request $request,$id){
        $edit_class=StudentClass::find($id);


        return view('backend.setup.edit_student_class',compact('edit_class'));

    }
    public function UpdateClass(Request $request, $id){
        $data=StudentClass::find($id);
        $validatedData=$request->validate([
            'name'=>'required|unique:student_classes,name,'.$data->id

        ]);
        $data->name= $request->name;
        $data->save();
        $notification =array(
            'message'=>'Student Class Updated Successfully',
            'alert-type'=>'info'

        );
        return redirect()->route('student.class.view')->with($notification);

    }
}
