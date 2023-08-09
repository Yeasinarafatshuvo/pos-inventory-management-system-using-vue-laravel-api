<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Image;
class EmployeeController extends Controller
{

    public function getAllEmployee()
    {
        $all_employee_data = Employee::all();

        return response()->json([
            'success' => true,
            'data' => $all_employee_data,
            'message' => 'All Employee Data',
        ], 201);

    }
    
    public function store_employee(Request $request)
    {
       
        $validate_data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|unique:employees,phone',
            'address' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date'
        ]);
      
        $employee = new Employee();

        if($request->photo)
        {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->photo = $image_url;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;

        }else{
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;

        }

        $save_employee = $employee->save();

        if($save_employee)
        {
            return response()->json([
                'success' => true,
                'message' => 'Employee Created successfully',
            ], 201);
        }


    }

    public function get_sepecefic_employee_data($id)
    {
        $specefic_employee_data = Employee::where('id' , $id)->first();
     
        if($specefic_employee_data !== NULL){
            return response()->json([
                'success' => true,
                'data' => $specefic_employee_data,
                'message' => 'Employee specefic Data ',
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Employee Not Found!',
            ], 201);
        }


    }

    public function update_employee(Request $request, $id)
    {
        $validate_data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date'
        ]);

        
        $employee = Employee::find($id);
        
        if($request->photo_update == 1){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            
            $employee_data = Employee::where('id' , $id)->first();
            $image_path = $employee_data->photo;

            try {
                if (file_exists($image_path)) {
                    unlink($image_path);
                } else{
                    
                }
            } catch (Exception $e){

            }

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->photo = $image_url;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;


        }else{
            $employee_data = Employee::where('id' , $id)->first();
            $old_photo = $employee_data->photo;

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->photo = $old_photo;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;
        }

        $update_employee = $employee->update();

        if($update_employee)
        {
            return response()->json([
                'success' => true,
                'message' => 'Employee Updated successfully',
            ], 201);
        }
        

    }
}
