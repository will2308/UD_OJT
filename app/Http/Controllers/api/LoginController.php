<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function dologin(Request $req){
        $data = [
            'email' => $req->email,
            'password' => $req->passsword,
        ];

        if (Auth::Attempt($data)) {
            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Login Gagal',
            ]);
        }
    }

    public function dologout(){
        Auth::logout();
        return response()->json([
            'status'=> true,
            'message' => ' berhasil logout',
        ],200);  
    }
}
