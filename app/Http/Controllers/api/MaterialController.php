<?php

namespace App\Http\Controllers\api;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $material = Material::all();
        return response()->json([
            'status'=> true,
            'message' => 'data berhasil ditemukan',
            'data' => $material
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
        $material = new Material();
        
        $rules = [
            'name' => 'required',
            'code_material' => 'required',
            'stock' => 'required',
            'material_category' => 'required',
            'expired' => 'required',
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

        $material->name = $req->name;
        $material->code_material = $req->code_material;
        $material->stock = $req->stock;
        $material->material_category = $req->material_category;
        $material->expired = $req->expired;
        $material->price = $req->price;
        $material->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $material
        ],200);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material, string $id)
    {
        $material = Material::find($id);
        if($material){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $material
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
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Material $material, string $id)
    {
        $material = Material::find($id);

        $rules = [
            'name' => 'required',
            'code_material' => 'required',
            'stock' => 'required',
            'material_category' => 'required',
            'expired' => 'required',
            'price' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        
        if(empty($material)){
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

        $material->name = $req->name;
        $material->code_material = $req->code_material;
        $material->stock = $req->stock;
        $material->material_category = $req->material_category;
        $material->expired = $req->expired;
        $material->price = $req->price;
        $material->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil diupdate',
            'data' => $material
        ],200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material, string $id)
    {
        $material = Material::find($id);
      
        if(empty($material)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
            ],404);
        }
        
        $material->delete();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil dihapus',
        ],200);  
    }
}
