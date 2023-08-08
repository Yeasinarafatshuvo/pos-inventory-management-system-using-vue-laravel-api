<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //user login api - POST
    public function user_login(Request $request)
    {
        $request->validate([
            'email' => 'required| email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        
        if($token = $this->guard()->attempt($credentials)){
            return $this->respondWithToken($token);
        }

        return response()->json([
            'success' => false,
            'error' => 'Unauthorized'
        ], 401);

    }

    public function user_logout()
    {
        $this->guard()->logout();
        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ], 201);
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);

    }


    public function guard()
    {
        return Auth::guard();
    }

    public function user_registration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required| email',
            'password' => 'required |min:6|confirmed'
        ]);
        

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save_data = $user->save();

        if($save_data){
            return response()->json([
                'success' => true,
                'message' => 'User Registration successfully',
            ], 201);
        }
       

    }






}
