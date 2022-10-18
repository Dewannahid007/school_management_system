<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    //
    public function ViewDesignation(){
        $data['allData']=Designation::all();

        return view('backend.setup.designation.designation_view',$data);
    }
    public function AddDesignation(){

        return view('backend.setup.designation.designation_add');

    }
    public function StoreDesignation(Request $request){
        $validatedData=$request->validate([
            'name'=>'required | unique:designations,name'

        ]);
        $data = new Designation();
        $data->name=$request->name;
        $data->save();

        $notification = array(
            'message'=>'Designation Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('designation.view')->with($notification);
    }
    public function EditDesignation($id){
        $data['records'] = Designation::find($id);

        return view('backend.setup.designation.designation_edit',$data);
    }
    public function UpdateDesignation(Request $request,$id){
        $data=Designation::find($id);
        $validatedData=$request->validate([
            'name'=>'required|unique:designations,name,'.$data->id

        ]);
        $data->name=$request->name;
        $data->save();
        $notification =array(
            'message'=>'Designation Updated Successfully',
            'alert-type'=>'info'

        );
        return redirect()->route('designation.view')->with($notification);
    }
    public function DeleteDesignation($id){
        $data=Designation::find($id);
        $data->delete();

$notification =array(
            'message'=>'Designation Delete Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('designation.view')->with($notification);

    }
}
