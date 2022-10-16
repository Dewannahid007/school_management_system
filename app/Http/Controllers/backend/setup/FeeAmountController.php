<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\FeeAmount;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    //
    public function ViewFeeAmount(){
        $data['allData']=FeeAmount::all();

        return view('backend.setup.fee.fee_amount_view',$data);
    }
    public function AddFeeAmount(){
        $data['fee_categories']= FeeCategory::all();
        $data['classes']=StudentClass::all();



        return view('backend.setup.fee.fee_amount_add',$data);

    }
}
