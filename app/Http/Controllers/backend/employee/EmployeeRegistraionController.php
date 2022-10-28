<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeRegistraionController extends Controller
{
    //
    public function EmployeeView(){

        return view('backend.employee.reg_employee_view');
    }
}
