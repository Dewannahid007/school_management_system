<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    //
    public function SchoolSubject(){
        $records=SchoolSubject::all();

        return view('backend.setup.subject.school_subject_view',compact('records'));

    }
    public function AddSchoolSubject(){

        return view('backend.setup.subject.school_subject_add');
    }
    public function StoreSchoolSubject(Request $request){
        $validatedData=$request->validate([
            'name'=>'required | unique:school_subjects,name'

        ]);
        $data = new SchoolSubject();
        $data->name=$request->name;
        $data->save();

        $notification = array(
            'message'=>'School Subject Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('school.subject.view')->with($notification);

    }
    public function EditSchoolSubject(Request $request, $id){
        $data = SchoolSubject::find($id);

        return view('backend.setup.subject.school_subject_edit',compact('data'));

    }
    public function UpdateSchoolSubject(Request $request, $id){
        $data=SchoolSubject::find($id);
        $validatedData=$request->validate([
            'name'=>'required|unique:school_subjects,name,'.$data->id

        ]);
        $data->name=$request->name;
        $data->save();
        $notification =array(
            'message'=>'School Subject Updated Successfully',
            'alert-type'=>'info'

        );

        return redirect()->route('school.subject.view')->with($notification);

    }
    
    public function DeleteSchoolSubject(Request $request, $id){
        $data=SchoolSubject::find($id);
        $data->delete();

$notification =array(
            'message'=>'School Subject Delete Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('school.subject.view')->with($notification);

    }
}
