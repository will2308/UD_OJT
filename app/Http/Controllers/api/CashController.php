<?php

namespace App\Http\Controllers\api;

use App\Models\Cash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cash = Cash::all();
        return response()->json([
            'status'=> true,
            'message' => 'data berhasil ditemukan',
            'data' => $cash
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
        $cash = new Cash();
        
        $rules = [
            'count' => 'required',
            'desc' => 'required',
            'verify' => 'required'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'data belum lengkap',
                'data' => $validator->errors()
            ]);    
        }

        $cash->name = "kas";
        $cash->count = $req->count;
        $cash->desc = $req->desc;
        $cash->verify = $req->verify;
        $cash->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $cash
        ],200);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function show(Cash $cash, string $id)
    {
        $cash = Cash::find($id);
        if($cash){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $cash
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
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function edit(Cash $cash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Cash $cash, string $id)
    {
        $cash = Cash::find($id);

        $rules = [
            'count' => 'required',
            'desc' => 'required',
            'verify' => 'required'
        ];
        $validator = Validator::make($req->all(), $rules);
        
        if(empty($cash)){
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

        $cash->name = $cash->name;
        $cash->count = $req->count;
        $cash->desc = $req->desc;
        $cash->verify = $req->verify;
        $cash->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil diupdate',
            'data' => $cash
        ],200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cash $cash, string $id)
    {
        $cash = Cash::find($id);
      
        if(empty($cash)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
            ],404);
        }
        
        $cash->delete();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil dihapus',
        ],200);  
    }
}
