<?php

namespace App\Http\Controllers\api;

use App\Models\Tr_buy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TrBuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trbuy = Tr_buy::all();
        return response()->json([
            'status'=> true,
            'message' => 'data berhasil ditemukan',
            'data' => $trbuy
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
        $trbuy = new Tr_buy();
        
        $rules = [
            'user' => 'required',
            'materials' => 'required',
            'date' => 'required',
            'price' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'data belum lengkap',
                'data' => $validator->errors()
            ]);    
        }

        $trbuy->user = $req->user;
        $trbuy->materials = $req->materials;
        $trbuy->date = $req->date;
        $trbuy->price = $req->price;
        $trbuy->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $trbuy
        ],200);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tr_buy  $tr_buy
     * @return \Illuminate\Http\Response
     */
    public function show(Tr_buy $tr_buy, string $id)
    {
        $trbuy = Tr_buy::find($id);
        if($trbuy){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $trbuy
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
     * @param  \App\Models\Tr_buy  $tr_buy
     * @return \Illuminate\Http\Response
     */
    public function edit(Tr_buy $tr_buy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tr_buy  $tr_buy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Tr_buy $tr_buy, string $id)
    {
        $trbuy = Tr_buy::find($id);

        $rules = [
            'user' => 'required',
            'materials' => 'required',
            'date' => 'required',
            'price' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        
        if(empty($trbuy)){
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

        $trbuy->user = $req->user;
        $trbuy->materials = $req->materials;
        $trbuy->date = $req->date;
        $trbuy->price = $req->price;
        $trbuy->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil diupdate',
            'data' => $trbuy
        ],200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tr_buy  $tr_buy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tr_buy $tr_buy, string $id)
    {
        $trbuy = Tr_buy::find($id);
      
        if(empty($trbuy)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
            ],404);
        }
        
        $trbuy->delete();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil dihapus',
        ],200); 
    }
}
