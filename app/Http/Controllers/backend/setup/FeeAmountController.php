<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\FeeAmount;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class FeeAmountController extends Controller
{
    //
    public function ViewFeeAmount(){
        //$data['allData']=FeeAmount::all();
        $data['allData'] = FeeAmount::select('fee_category_id')->groupBy('fee_category_id')->get();

        return view('backend.setup.fee.fee_amount_view',$data);
    }
    public function AddFeeAmount(){

        $data['fee_categories']= FeeCategory::all();
        $data['classes']=StudentClass::all();
        return view('backend.setup.fee.fee_amount_add',$data);

    }
    public function StoreFeeAmount(Request $request){
         $countClass= count($request->class_id);
         if($countClass !=null){
            for($i=0; $i<$countClass; $i++){
                $fee_amount= new FeeAmount();
                $fee_amount->fee_category_id=$request->fee_category_id;
                $fee_amount->class_id=$request->class_id[$i];
                $fee_amount->amount=$request->amount[$i];
                $fee_amount->save();


            }
         }
         $notification=array(
            'message'=>'Fee Amount Inserted Successfully',
            'alert-type'=>'info'

         );
         return redirect()->route('fee.amount.view')->with($notification); 

    }
    public function EditFeeAmount(Request $request,$fee_category_id){
        $data['editData']= FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();

        $data['fee_categories']= FeeCategory::all();
        $data['classes']=StudentClass::all();
        return view('backend.setup.fee.fee_amount_edit',$data);

    }
    public function UpdateFeeAmount(Request $request, $fee_category_id){
        if($request->class_id ==NULL){

            $notification=array(
            'message'=>'Sorry You do not select any class Amount',
            'alert-type'=>'error'

         );
         return Redirect()->route('fee.amount.edit',$fee_category_id)->with($notification);


        }else{

              $countClass= count($request->class_id);
              FeeAmount::where('fee_category_id',$fee_category_id)->delete();
            for($i=0; $i<$countClass; $i++){
                $fee_amount= new FeeAmount();
                $fee_amount->fee_category_id=$request->fee_category_id;
                $fee_amount->class_id=$request->class_id[$i];
                $fee_amount->amount=$request->amount[$i];
                $fee_amount->save();
            }
         
         $notification=array(
            'message'=>'Fee Amount Updated Successfully',
            'alert-type'=>'success'

         );
         return redirect()->route('fee.amount.view')->with($notification); 

        }
    }
    public function DetailsFeeAmount($fee_category_id){
        $data['detailsData']=FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();

        return view('backend.setup.fee.fee_amount_details',$data);

         
         

    }
}
