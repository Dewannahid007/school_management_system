<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function UserView(){
        $allData =User::all();
        return view('backend.user.view_user',compact('allData'));


    }
}
