<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    //buat fungsi index
    function index()
    {
        $employee = Employee::get(['employee_id','employee_name','employee_address','employee_phone_number']);
        return view('employee.index', compact('employee'));
    }
    public function show($id) 
    {
        $employee = Employee::where('employee_id', $id)->get();
         return view('employee.show', compact('employee'));
    } 
    function create() 
    {
        return view('employee.create');
    }
    public function store(Request $request) 
   {
        $txtId = $request->input('txt_id');
        $txtName = $request->input('txt_name');
        $txtAddress = $request->input('txt_address');
        $txtPhone = $request->input('txt_phone_number');

        echo $txtId. "<br />".
            $txtName. "<br />".
            $txtAddress. "<br />".
            $txtPhone;

        Employee::create([
            'employee_id' => $txtId,
            'employee_name' => $txtName,
            'employee_address' => $txtAddress,
            'employee_phone_number' => $txtPhone
        ]);
        return 
        redirect('/Employee');       
    }

    function edit($id) {
        $employee = Employee::where('employee_id', $id)->get();
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $txtId = $request->input('txt_id');
        $txtName = $request->input('txt_name');
        $txtAddress = $request->input('txt_address');
        $txtPhone = $request->input('txt_phone_number');
        
        Employee::where('employee_id', $id)->update([
            'employee_name' => $txtName,
            'employee_address' => $txtAddress,
            'employee_phone_number' =>$txtPhone
        ]);
        return redirect('/Employee');  
    }
    public function destroy($id)
        {
            $employee = Employee::where('employee_id', $id)->first();
            $employee->delete();
            return redirect('/Employee');
                      
        }
}
