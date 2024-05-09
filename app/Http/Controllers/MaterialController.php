<?php

namespace App\Http\Controllers;

use App\Models\Material;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token =  session()->get('login_token');
        if($token == null){
            return redirect()->to('login')->with('error', 'anda belum login');
        } else {
            if(session()->get('login_data')['role'] == 'customer'){
                return redirect()->to('')->with('error', 'anda bukan admin');
            } else {

                $material = new Client();
                $url = 'localhost:8000/api/material';
                $reponse = $material->request('get', $url, [
                    'headers' => [ 'Authorization' => 'Bearer ' . $token ],
                ]);
                $gt_content = json_decode($reponse->getBody()->getContents(), true);
                $data = $gt_content['data'];

                $urlcat = 'localhost:8000/api/materialcategory';
                $reponsecat = $material->request('get', $urlcat, [
                    'headers' => [ 'Authorization' => 'Bearer ' . $token ],
                ]);
                $gt_category = json_decode($reponsecat->getBody()->getContents(), true);
                $category = $gt_category['data'];
                // echo $gt_content;
                // print_r($category);
                // $getar = array_search('4', array_column($category, 'id'));
                // echo $category[$getar]['desc'];
                // echo "<br>";
                return view('content.admin.material', ['data'=> $data, 'category'=> $category]);
            }
        }
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
        $token =  session()->get('login_token');
        $name = $req->name;
        $code_material = $req->code_material;
        $stock = $req->stock;
        $material_category = $req->material_category;
        $expired = $req->expired;
        $price = $req->price;
        $parameter = [
            'name'=> $name,
            'code_material'=> $code_material,
            'stock'=> $stock,
            'material_category'=> $material_category,
            'expired'=> $expired,
            'price'=> $price,
        ];

        $material = new Client();
        $url = 'localhost:8000/api/material';
        $reponse = $material->request('post', $url, [
            'headers'=>[
                'Content-type'=>'aplication/json',
                'Authorization' => 'Bearer ' . $token,
            ],
            'body'=>json_encode($parameter)
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // $data = $gt_content['data'];
        // echo $gt_content;
        // print_r($data);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('material')->withErrors($error)->withInput();
        }else {
            return redirect()->to('material')->with('success', 'berhasil menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material, Request $req, $id)
    {
        $token =  session()->get('login_token');
        $name = $req->name;
        $code_material = $req->code_material;
        $stock = $req->stock;
        $material_category = $req->material_category;
        $expired = $req->expired;
        $price = $req->price;
        $parameter = [
            'name'=> $name,
            'code_material'=> $code_material,
            'stock'=> $stock,
            'material_category'=> $material_category,
            'expired'=> $expired,
            'price'=> $price,
        ];

        $material = new Client();
        $url = 'localhost:8000/api/material/'.$id;
        $reponse = $material->request('put', $url, [
            'headers'=>[
                'Content-type'=>'aplication/json',
                'Authorization' => 'Bearer ' . $token,
            ],
            'body'=>json_encode($parameter)
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // // $data = $gt_content['data'];
        // // echo $gt_content;
        // // print_r($data);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('material')->withErrors($error)->withInput();
        }else {
            return redirect()->to('material')->with('success', 'berhasil mengubah data');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material, $id)
    {
        $token =  session()->get('login_token');
        $material = new Client();
        $url = 'localhost:8000/api/material/'.$id;
        $reponse = $material->request('delete', $url, [
            'headers' => [ 'Authorization' => 'Bearer ' . $token ], 
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('material')->withErrors($error)->withInput();
        }else {
            return redirect()->to('material')->with('success', 'berhasil menghapus data');
        }
    }
}
