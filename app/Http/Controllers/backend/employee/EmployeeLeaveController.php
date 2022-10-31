<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    //
    public function EmployeeLeaveView(){
        $data['allData']=EmployeeLeave::orderBY('id','desc')->get();

        return view('backend.employee.leave.employee_leave_view',$data);

    }
    public function EmployeeLeaveAdd(){
        $data['employees'] = User::where('usertype','Employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();

        return view('backend.employee.leave.employee_leave_add',$data);
    }
    public function EmployeeLeaveStore(Request $request){

        if($request->leave_purpose_id == "0"){
            $leavePurpose = new LeavePurpose();
            $leavePurpose->name=$request->name;
            $leavePurpose->save();
            $leave_purpose_id = $leavePurpose->id;

        }else{
            $leave_purpose_id = $request->leave_purpose_id;

        }
        $data= new EmployeeLeave();
        $data->employee_id=$request->employee_id;
        $data->leave_purpose_id=$leave_purpose_id;
        $data->start_date= date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));

        $data->save();

        $notification= array(
            'message'=>'Employee Leave Insert Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('employee.leave.view')->with($notification);

    }

    public function EmployeeLeaveEdit($id){

        $data['editData']= EmployeeLeave::find($id);
        $data['employees'] = User::where('usertype','Employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();

        return view('backend.employee.leave.employee_leave_edit',$data);

    }
    public function EmployeeLeaveUpdate(Request $request, $id){
        if($request->leave_purpose_id == "0"){
            $leavePurpose = new LeavePurpose();
            $leavePurpose->name=$request->name;
            $leavePurpose->save();
            $leave_purpose_id = $leavePurpose->id;

        }else{
            $leave_purpose_id = $request->leave_purpose_id;

        }
        $data= EmployeeLeave::find($id);
        $data->employee_id=$request->employee_id;
        $data->leave_purpose_id=$leave_purpose_id;
        $data->start_date= date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));

        $data->save();

        $notification= array(
            'message'=>'Employee Leave Data Updated Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('employee.leave.view')->with($notification);

    }

    public function EmployeeLeaveDelete($id){
        $data=EmployeeLeave::find($id);
        $data->delete();
        $notification=array(
            'message'=>'Employee Data Deleted Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('employee.leave.view')->with($notification);
    }
}
