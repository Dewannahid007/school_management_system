<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{
    //
    public function UserView(){
        $allData =User::all();
        return view('backend.user.view_user',compact('allData'));


    }
    public function UserAdd(){

        return view('backend.user.add_user');

    }
    public function UserStore(Request $request){
        $validatedData = $request->validate([
           'name'=>'Required',
           'usertype'=>'required',
           'email'=>'required|unique:users',

        ]);
        $data = new User();
        $data->usertype=$request->usertype;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=bcrypt($request->password);
        $data->save();
        $notification = array(
            'message'=> 'User insert Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('user.view')->with($notification);

    }
    public function UserEdit(Request $request,$id){
        $editData=User::find($id);
        return view('backend.user.edit_user',compact('editData'));

    }
    public function UserUpdate(Request $request,$id){
        $data =User::find($id);
        $data->usertype=$request->usertype;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->save();

        $notification =array(
            'message'=> 'User Updated Successfully',
            'alert-type' =>'info'
        );


        return redirect()->route('user.view')->with($notification);


    }
    public function UserDelete(Request $request,$id){
        $data =User::find($id);
        $data->delete();
        $notification =array(
            'message'=>'User Deleted Successfully',
            'alert-type'=>'info'

        );
        return redirect()->route('user.view')->with($notification);
    }

}
