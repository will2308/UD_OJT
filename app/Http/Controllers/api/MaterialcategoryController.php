<?php

namespace App\Http\Controllers\api;

use App\Models\Materialcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class MaterialcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materialcategory = Materialcategory::all();
        return response()->json([
            'status'=> true,
            'message' => 'data berhasil ditemukan',
            'data' => $materialcategory
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
        $materialcategory = new Materialcategory();
        
        $rules = [
            'name' => 'required',
            'desc' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'data belum lengkap',
                'data' => $validator->errors()
            ]);    
        }

        $materialcategory->name = $req->name;
        $materialcategory->desc = $req->desc;
        $materialcategory->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $materialcategory
        ],200);   

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materialcategory  $materialcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Materialcategory $materialcategory,string $id)
    {
        $materialcategory = Materialcategory::find($id);
        if($materialcategory){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $materialcategory
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
     * @param  \App\Models\Materialcategory  $materialcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Materialcategory $materialcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materialcategory  $materialcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Materialcategory $materialcategory, string $id)
    {
        $materialcategory = Materialcategory::find($id);

        $rules = [
            'name' => 'required',
            'desc' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        
        if(empty($materialcategory)){
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

        $materialcategory->name = $req->name;
        $materialcategory->desc = $req->desc;
        $materialcategory->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil diupdate',
            'data' => $materialcategory
        ],200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materialcategory  $materialcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materialcategory $materialcategory, string $id)
    {
        $materialcategory = Materialcategory::find($id);
      
        if(empty($materialcategory)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
            ],404);
        }
        
        $materialcategory->delete();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil dihapus',
        ],200);  
    }
}
