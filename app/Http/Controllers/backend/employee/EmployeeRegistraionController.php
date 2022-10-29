<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeRegistraionController extends Controller
{
    //
    public function EmployeeView(){
        $data['allData'] = User::where('usertype','Employee')->get();

        return view('backend.employee.reg_employee_view',$data);
    }
    public function EmployeeAdd(){
        $data['designation'] = Designation::all();

        return view('backend.employee.reg_employee_add',$data);

    }
    public function EmployeeStore(Request $request){
        DB::transaction(function() use($request){
            $checkyear = date('Ym',strtotime($request->join_date));
            $employee= User::where('usertype','Employee')->orderBy('id','DESC')->first();
            if($employee == null){
                $firstReg=0;
                $employeeId =$firstReg+1;
                if($employeeId<10){
                    $id_no ='000'.$employeeId;
                } elseif($employeeId<100){
                    $id_no = '00'.$employeeId; 
                }elseif($employeeId<1000){
                    $id_no = '0'.$employeeId;
                }
            
            }else{
                $employee = User::where('usertype','Employee')->orderBy('id','DESC')->first()->id;
                $employeeId = $employee+1;
                if($employeeId<10){
                    $id_no ='000'.$employeeId;
                } elseif($employeeId<100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId<1000){
                    $id_no = '0'.$employeeId;
                }

            }

            $final_id_no = $checkyear.$id_no;
            $user = new User();
            $code =rand(0000,9999);
            $user->id_no=$final_id_no;
            $user->password = bcrypt($code);
            $user->usertype ='Employee';
            $user->code =$code;
            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;
            $user->salary=$request->salary;
            $user->designation_id=$request->designation_id;
            $user->dob =date('y-m-d',strtotime($request->dob));
            $user->join_date =date('y-m-d',strtotime($request->join_date));

            if($request->file('image')){
            $file=$request->file('image');
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/employee_images'),$filename);
            $user['image']=$filename;
              }
              $user->save();

              $employee_salary = new EmployeeSalaryLog();
              $employee_salary->employee_id=$user->id;
              $employee_salary->effected_salary =date('Y-m-d',strtotime($request->join_date));
              $employee_salary->previous_salary= $request->salary;
              $employee_salary->present_salary= $request->salary;
              $employee_salary->increment_salary = '0';
              $employee_salary->save();

        });
        $notification =array(

            'message'=>'Employee Registration Inserted SuccessFully',
            'alert-type'=>'success'
         );
         return redirect()->route('employee.reg.view')->with($notification);
        
    }
    
}
