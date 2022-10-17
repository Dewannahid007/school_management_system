<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    //
    public function ExamType(){
        $data['examType']=ExamType::all();

        return view('backend.setup.exam_type.exam_type_view',$data);

    }
    public function AddExamType(){
        return view('backend.setup.exam_type.exam_type_add');
    }
    public function StoreExamType(Request $request){
        $validatedData=$request->validate([
            'name'=>'required | unique:exam_types,name'

        ]);
        $data = new ExamType();
        $data->name=$request->name;
        $data->save();

        $notification = array(
            'message'=>'Exam Type Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }
    public function EditExamType(Request $request,$id){
        $data['records'] = ExamType::find($id);

        return view('backend.setup.exam_type.exam_type_edit',$data);



    }
    public function UpdateExamType(Request $request,$id){
        $data=ExamType::find($id);
        $validatedData=$request->validate([
            'name'=>'required | unique:exam_types,name'.$data->id

        ]);
        $data->name=$request->name;
        $data->save();
        $notification =array(
            'message'=>'Exam Type Updated Successfully',
            'alert-type'=>'info'

        );
        return redirect()->route('exam.type.view')->with($notification);


    }
    public function DeleteExamType($id){
        $data=ExamType::find($id);
        $data->delete();

$notification =array(
            'message'=>'Exam Type Delete Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('exam.type.view')->with($notification);

    }
}
