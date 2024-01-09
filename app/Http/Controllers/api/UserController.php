<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json([
            'status'=> true,
            'message' => 'data berhasil ditemukan',
            'data' => $user
        ],200);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
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
        $user->password = $req->password;
        $user->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $user
        ],200);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, string $id)
    {
        $user = User::find($id);
        if($user){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $user
            ],200);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tr_sale  $tr_sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, User $user, string $id)
    {
        $user = User::find($id);

        $rules = [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'desc' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        
        if(empty($user)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
                'data' => $validator->errors()
            ],404);   
        }
        
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
        $user->password = $req->password;
        $user->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil diupdate',
            'data' => $user
        ],200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, string $id)
    {
        $user = User::find($id);
      
        if(empty($user)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
            ],404);
        }
        
        $user->delete();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil dihapus',
        ],200); 
    }
}
