<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\FeeAmount;
use App\Models\StudentClass;
use App\Models\StudentShift;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class RegistrationFeeController extends Controller
{
    //
    public function RegistrationFeeView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        return view('backend.student.registration_fee.registration_fee_view',$data);

    }
    public function RegFeeClassData(Request $request){

    $year_id = $request->year_id;
   	$class_id = $request->class_id;
    if($year_id !='' ){
        $where[] = ['year_id','like',$year_id.'%'];
    }
    if($class_id !='' ){
        $where[] = ['class_id','like',$class_id.'%'];
    }   	   
    	 
  $allStudent = AssignStudent::with(['discount'])->where($where)->get();
    	 
    	 $html['thsource']  = '<th>SL</th>';
    	 $html['thsource'] .= '<th>ID No</th>';
    	 $html['thsource'] .= '<th>Student Name</th>';
    	 $html['thsource'] .= '<th>Roll No </th>';
      	 $html['thsource'] .= '<th>Reg Fee</th>';
      	 $html['thsource'] .= '<th>Discount</th>';
      	 $html['thsource'] .= '<th>Student Fee</th>';
         $html['thsource'] .= '<th>Action</th>';


    	 foreach ($allStudent as $key => $v) {
      $registrationfee= FeeAmount::where('fee_category_id','1')->where('class_id',$v->class_id)->first();

 	$color = 'success';
 	$html[$key]['tdsource']  = '<td>'.($key+1).'</td>';

 	 $html[$key]['tdsource']  .= '<td>'.$v['student']['id_no'].'</td>';
     $html[$key]['tdsource']  .= '<td>'.$v['student']['name'].'</td>';
     $html[$key]['tdsource']  .= '<td>'.$v->roll.'</td>';
     $html[$key]['tdsource']  .= '<td>'.$v->amount.'</td>';
     $html[$key]['tdsource']  .= '<td>'.$v['discount']['discount'].'%'.'</td>';
 	 $orginalfee = $v->amount;
 	 $discount = $v['discount']['discount'];
 	 $discountablefee = $discount/100*$orginalfee;
 	 $finalfee = (float)$orginalfee-(float)$discountablefee;    	 	 

 	 $html[$key]['tdsource'] .='<td>'.$finalfee.'$'.'</td>';
     $html[$key]['tdsource'] .='<td>';
     $html[$key]['tdsource'] .='<a class ="btn btn-sm btn-'.$color.'"
     title="PaySlip" target="_blanks" href="'.route("student.registration.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'">Fee Slip</a>';
     $html[$key]['tdsource'].='</td>';
  
    	 }  
    	return response()->json(@$html);
    }
    public function RegFeePayslip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;

        $allStudent['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->where('class_id',$class_id)->first();

        $pdf = PDF::loadView('backend.student.registration_fee.registration_fee_pdf',$allStudent);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');





    }
}
