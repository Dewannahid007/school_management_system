<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class StudentGroupController extends Controller
{
    //
    public function ViewGroup(){
        $groups=StudentGroup::all();

        return view('backend.group.student_group_view',compact('groups'));
    }
    public function AddGroup(){
        return view('backend.group.student_group_add');

    }
    public function StoreGroup(Request $request){
        $validatedData=$request->validate([
            'name'=>'required | unique:student_groups,name'

        ]);

        $data= new StudentGroup();
        $data->name=$request->name;
        $data->save();

        $notification=array(
            'message'=>'Student Group Insert Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('student.group.view')->with($notification);

    }
    public function EditGroup(Request $request,$id){
        $records = StudentGroup::find($id);

        return view('backend.group.student_group_edit',compact('records'));

    }
    public function UpdateGroup(Request $request,$id){
        $data=StudentGroup::find($id);
        $validatedData=$request->validate([
            'name'=>'required|unique:student_groups,name,'.$data->id

        ]);
        $data->name=$request->name;
        $data->save();
        $notification =array(
            'message'=>'Student Class Updated Successfully',
            'alert-type'=>'info'

        );
        return redirect()->route('student.group.view')->with($notification);


    }
    public function DeleteGroup(Request $request ,$id){
        $deleteGroup = StudentGroup::find($id);
        $deleteGroup->delete();

        $notification = array(
            'message'=>'Student Group deleted Successfully',
            'alert-type'=>'success'

        );

        return redirect()->route('student.group.view')->with($notification);
    }
}
