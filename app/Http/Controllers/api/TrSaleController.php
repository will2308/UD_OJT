<?php

namespace App\Http\Controllers\api;

use App\Models\Tr_sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TrSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tr_sale = Tr_sale::all();
        return response()->json([
            'status'=> true,
            'message' => 'data berhasil ditemukan',
            'data' => $tr_sale
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
        $tr_sale = new Tr_sale();
        
        $rules = [
            'customer' => 'required',
            'admin' => 'required',
            'product' => 'required',
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

        $tr_sale->customer = $req->customer;
        $tr_sale->admin = $req->admin;
        $tr_sale->product = $req->product;
        $tr_sale->promo = $req->promo;
        $tr_sale->date = $req->date;
        $tr_sale->price = $req->price;
        $tr_sale->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $tr_sale
        ],200);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tr_sale  $tr_sale
     * @return \Illuminate\Http\Response
     */
    public function show(Tr_sale $tr_sale, string $id)
    {
        $tr_sale = Tr_sale::find($id);
        if($tr_sale){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $tr_sale
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
     * @param  \App\Models\Tr_sale  $tr_sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Tr_sale $tr_sale)
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
    public function update(Request $req, Tr_sale $tr_sale, string $id)
    {
        $tr_sale = Tr_sale::find($id);

        $rules = [
            'customer' => 'required',
            'admin' => 'required',
            'product' => 'required',
            'date' => 'required',
            'price' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        
        if(empty($tr_sale)){
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

        $tr_sale->customer = $req->customer;
        $tr_sale->admin = $req->admin;
        $tr_sale->product = $req->product;
        $tr_sale->promo = $req->promo;
        $tr_sale->date = $req->date;
        $tr_sale->price = $req->price;
        $tr_sale->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil diupdate',
            'data' => $tr_sale
        ],200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tr_sale  $tr_sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tr_sale $tr_sale, string $id)
    {
        $tr_sale = Tr_sale::find($id);
      
        if(empty($tr_sale)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
            ],404);
        }
        
        $tr_sale->delete();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil dihapus',
        ],200); 
    }
}
