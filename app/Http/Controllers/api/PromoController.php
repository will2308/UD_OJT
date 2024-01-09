<?php

namespace App\Http\Controllers\api;

use App\Models\Promo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo = Promo::all();
        return response()->json([
            'status'=> true,
            'message' => 'data berhasil ditemukan',
            'data' => $promo
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
        $promo = new Promo();
        
        $rules = [
            'name' => 'required',
            'desc' => 'required'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'data belum lengkap',
                'data' => $validator->errors()
            ]);    
        }

        $promo->name = $req->name;
        $promo->desc = $req->desc;
        $promo->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $promo
        ],200);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $promo, string $id)
    {
        $promo = Promo::find($id);
        if($promo){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $promo
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
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Promo $promo, string $id)
    {
        $promo = Promo::find($id);

        $rules = [
            'name' => 'required',
            'desc' => 'required'
        ];
        $validator = Validator::make($req->all(), $rules);
        
        if(empty($promo)){
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

        $promo->name = $req->name;
        $promo->desc = $req->desc;
        $promo->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil diupdate',
            'data' => $promo
        ],200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo, string $id)
    {
        $promo = Promo::find($id);
      
        if(empty($promo)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
            ],404);
        }
        
        $promo->delete();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil dihapus',
        ],200); 
    }
}
