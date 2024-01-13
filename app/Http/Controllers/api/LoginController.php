<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function register(Request $req){
        $user = new User();
        
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'desc' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'data belum lengkap',
                'data' => $validator->errors()
            ]);    
        }

        $user->name = $req->name;
        $user->email = $req->email;
        $user->role = $req->role;
        $user->desc = $req->desc;
        $user->pic = $req->pic;
        $user->password = Hash::make($req->password);
        $user->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $user
        ],200);
    }

    public function dologin(Request $req){
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status'=> false,
                'message' => ' Login gagal',
                'data' => $validator->errors(),
            ],401); 
        }
        if(!Auth::attempt($req->only(['email','password']))){
            return response()->json([
                'status'=> false,
                'message' => ' Password tidak sesuai',
            ],401); 
        }

        $data_user = User::where('email', $req->email)->first();
        // dd($data_user->createToken('auth_token')->plainTextToken);
        return response()->json([
            'status'=> true,
            'message' => ' Login berhasil',
            'login_token' => $data_user->createToken('auth_token')->plainTextToken,
            'login_data' => $data_user
        ],401); 

    }

    public function dologout(){
        Auth::logout();
        return response()->json([
            'status'=> true,
            'message' => ' berhasil logout',
        ],200);  
    }
}
