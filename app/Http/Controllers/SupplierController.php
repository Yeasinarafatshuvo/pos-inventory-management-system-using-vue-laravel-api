<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Image;
class SupplierController extends Controller
{
    public function create_supplier(Request $request)
    {
        $validate_data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|unique:suppliers,phone',
            'address' => 'required|string',
            
        ]);
          
        $supplier_instance = new Supplier();

        if($request->photo)
        {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);


            $supplier_instance->name = $request->name;
            $supplier_instance->email = $request->email;
            $supplier_instance->phone = $request->phone;
            $supplier_instance->address = $request->address;
            $supplier_instance->shop_name = $request->shop_name ?? null;
            $supplier_instance->photo = $image_url;

        }else{
            $supplier_instance->name = $request->name;
            $supplier_instance->email = $request->email;
            $supplier_instance->phone = $request->phone;
            $supplier_instance->address = $request->address;
            $supplier_instance->shop_name = $request->shop_name ?? null;
        }

        $save_supplier = $supplier_instance->save();

        if($save_supplier)
        {
            return response()->json([
                'success' => true,
                'message' => 'Supplier Created successfully',
            ], 201);
        }



    }

    public function get_all_supplier()
    {
        $all_supplier_data = Supplier::all();

        return response()->json([
            'success' => true,
            'data' => $all_supplier_data,
            'message' => 'All Supplier data',
        ], 201);


    }

    public function get_specefic_supplier_data($id)
    {
        $get_specefic_supplier_data = Supplier::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'data' => $get_specefic_supplier_data,
            'message' => 'Specefic Supplier Data',
        ], 201);

    }

    public function update_supplier(Request $request, $id)
    {

        $validate_data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string',
        ]);

        $supplier_instance = Supplier::find($id);
        if($request->photo_update == 1){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            
            $supplier_data = Supplier::where('id' , $id)->first();
            $image_path = $supplier_data->photo;

            try {
                if (file_exists($image_path)) {
                    unlink($image_path);
                } else{
                    
                }
            } catch (Exception $e){

            }

            $supplier_instance->name = $request->name;
            $supplier_instance->email = $request->email;
            $supplier_instance->phone = $request->phone;
            $supplier_instance->address = $request->address;
            $supplier_instance->shop_name = $request->shop_name ?? null;
            $supplier_instance->photo = $image_url;


        }else{
            $supplier_data = Supplier::where('id' , $id)->first();
            $old_photo = $supplier_data->photo;

            $supplier_instance->name = $request->name;
            $supplier_instance->email = $request->email;
            $supplier_instance->phone = $request->phone;
            $supplier_instance->address = $request->address;
            $supplier_instance->photo = $old_photo;
            $supplier_instance->shop_name = $request->shop_name ?? null;
        }

        $update_supplier = $supplier_instance->update();

        if($update_supplier)
        {
            return response()->json([
                'success' => true,
                'message' => 'Supplier Updated successfully',
            ], 201);
        }





    }
    

    public function delete_supplier($id)
    {
        $delete_supplier_data = Supplier::where('id', $id)->delete();

        if($delete_supplier_data > 0){
            return response()->json([
                'success' => true,
                'message' => 'Supplier Deleted Successfully'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Supplier Not Found!'
            ]);
        }

        
    }
}