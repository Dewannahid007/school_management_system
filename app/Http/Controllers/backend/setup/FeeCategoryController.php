<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    //
    public function ViewFeeCategory(){

        $records=FeeCategory::all();

        return view('backend.setup.fee_category_view',compact('records'));
    }
    public function AddFeeCategory(){

        return view('backend.setup.fee_category_add');
    }
    public function StoreFeeCategory(Request $request){
        $validated = $request->validate([

            'name'=>'required | unique:fee_categories,name'
        ]);
        
        $data= new FeeCategory();
        $data->name=$request->name;
        $data->save();
        
        $notification =array(
            'message'=>'Student Fee Category Inserted',
            'alert-type'=>'info'

        );
        return redirect()->route('fee.category.view')->with($notification);

    }
    public function EditFeeCategory(Request $request,$id){
        $data=FeeCategory::find($id);
        return view('backend.setup.fee_category_edit',compact('data'));
    }
    public function UpdateFeeCategory(Request $request, $id){
        $data=FeeCategory::find($id);
        $validatedData=$request->validate([
            'name'=>'required|unique:fee_categories,name,'.$data->id

        ]);
        $data->name=$request->name;
        $data->save();
        $notification =array(
            'message'=>'Student Fee Category Updated Successfully',
            'alert-type'=>'info'

        );
        return redirect()->route('fee.category.view')->with($notification);

    }
    public function DeleteFeeCategory(Request $request, $id){
        $data=FeeCategory::find($id);
        $data->delete();

        $notification =array(
            'message'=>'Student Fee Category Deleted Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('fee.category.view')->with($notification);

    }
}
