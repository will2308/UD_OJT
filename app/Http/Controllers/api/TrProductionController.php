<?php

namespace App\Http\Controllers\api;

use App\Models\Tr_production;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TrProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tr_production = Tr_production::all();
        return response()->json([
            'status'=> true,
            'message' => 'data berhasil ditemukan',
            'data' => $tr_production
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
        $tr_production = new Tr_production();
        
        $rules = [
            'name' => 'required',
            'desc' => 'required',
            'materials' => 'required',
            'expired' => 'required',
            'stock' => 'required',
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

        $tr_production->name = $req->name;
        $tr_production->materials = $req->materials;
        $tr_production->desc = $req->desc;
        $tr_production->promo = $req->promo;
        $tr_production->expired = $req->expired;
        $tr_production->picture = $req->picture;
        $tr_production->price = $req->price;
        $tr_production->stock = $req->stock;
        $tr_production->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $tr_production
        ],200);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tr_production  $tr_production
     * @return \Illuminate\Http\Response
     */
    public function show(Tr_production $tr_production, string $id)
    {
        $tr_production = Tr_production::find($id);
        if($tr_production){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $tr_production
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
     * @param  \App\Models\Tr_production  $tr_production
     * @return \Illuminate\Http\Response
     */
    public function edit(Tr_production $tr_production)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tr_production  $tr_production
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Tr_production $tr_production, string $id)
    {
        $tr_production = Tr_production::find($id);

        $rules = [
            'name' => 'required',
            'desc' => 'required',
            'materials' => 'required',
            'expired' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        
        if(empty($tr_production)){
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

        $tr_production->name = $req->name;
        $tr_production->materials = $req->materials;
        $tr_production->desc = $req->desc;
        $tr_production->promo = $req->promo;
        $tr_production->picture = $req->picture;
        $tr_production->price = $req->price;
        $tr_production->expired = $req->expired;
        $tr_production->stock = $req->stock;
        $tr_production->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil diupdate',
            'data' => $tr_production
        ],200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tr_production  $tr_production
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tr_production $tr_production, string $id)
    {
        $tr_production = Tr_production::find($id);
      
        if(empty($tr_production)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
            ],404);
        }
        
        $tr_production->delete();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil dihapus',
        ],200); 
    }
}
