<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

class StudentRegistrationController extends Controller
{
    //
    public function StudentRegistration(){
        $data['allData']=AssignStudent::all();

        return view('backend.student.student_registration',$data);
    }
    public function AddStudent(){
        $data['years']=StudentYear::all();
        $data['classes']=StudentClass::all();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();


        return view('backend.student.student_add',$data);
    }
    public function StoreStudent(Request $request){
            DB::transaction(function() use($request){
            $checkyear = StudentYear::find($request->year_id)->name;
            $student= User::where('usertype','S tudent')->orderBy('id','DESC')->first();
            if($student == null){
                $firstReg=0;
                $studentId =$firstReg+1;
                if($studentId<10){
                    $id_no ='000'.$studentId;
                } elseif($studentId<100){
                    $id_no = '00'.$studentId; 
                }elseif($studentId<1000){
                    $id_no = '0'.$studentId;
                }
            
            }else{
                $student = User::where('usertype','Student')->orderBy('id','DESC')->first()->id;
                $studentId = $student+1;
                if($studentId<10){
                    $id_no ='000'.$studentId;
                } elseif($studentId<100){
                    $id_no = '00'.$studentId;
                }elseif($studentId<1000){
                    $id_no = '0'.$studentId;
                }

            }

            $final_id_no = $checkyear.$id_no;
            $user = new User();
            $code =rand(0000,9999);
            $user->id_no=$final_id_no;
            $user->password = bcrypt($code);
            $user->usertype ='Student';
            $user->code =$code;
            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;
            $user->dob =date('y-m-d',strtotime($request->dob));
            if($request->file('image')){
            $file=$request->file('image');
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/student_images/'),$filename);
            $user['image']=$filename;

              }

              $user->save();

        });
    }
}
