<?php

namespace App\Http\Controllers;

use App\Models\Tr_production;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TrProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trproduction = new Client();
        $url = 'localhost:8000/api/trproduction';
        $reponse = $trproduction->request('get', $url);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        $data = $gt_content['data'];

        $urlmat = 'localhost:8000/api/material';
        $reponsecat = $trproduction->request('get', $urlmat);
        $gt_mat = json_decode($reponsecat->getBody()->getContents(), true);
        $materials = $gt_mat['data'];

        $urlpromo = 'localhost:8000/api/promo';
        $reponsepromo = $trproduction->request('get', $urlpromo);
        $gt_promo = json_decode($reponsepromo->getBody()->getContents(), true);
        $promo = $gt_promo['data'];
        // echo $gt_content;
        // print_r($data);
        return view('content.admin.trproduction', ['data'=> $data, 'materials'=> $materials,'promo' => $promo]);
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
        $mat_id = $req->materials;
        $mat_count = $req->materials_count;
        $name = $req->name;
        $desc = $req->desc;
        $promo = $req->promo;
        $expired = $req->expired;
        $stock = $req->stock;
        // $picture = $req->picture;
        $price = $req->price;
        $materials = [];

        for ($i=0; $i < count($mat_id); $i++) { 
            $data_materials = [
                'id' => $mat_id[$i],
                'count' => $mat_count[$i],
            ];

            $dt_mat = json_encode($data_materials);
            array_push($materials,  $dt_mat);

            $trproduction = new Client();
            // get data bahan 
            $url_get_mat = 'localhost:8000/api/material/'.$mat_id[$i];
            $reponse_get_mat = $trproduction->request('get', $url_get_mat);
            $dt_mat = json_decode($reponse_get_mat->getBody()->getContents(), true);
            $mats = $dt_mat['data'];

            // inisiasi bahan 
            $material_name = $mats['name'];
            $material_code_material = $mats['code_material'];
            $material_stock = ($mats['stock'] - $mat_count[$i]);
            $material_material_category = $mats['material_category'];
            $material_expired = $mats['expired'];
            $material_price = $mats['price'];

            $edt_materials = [
                "name" => $material_name,
                "code_material" => $material_code_material,
                "stock" => $material_stock,
                "material_category" => $material_material_category,
                "expired" => $material_expired,
                "price" => $material_price,
            ];

            // print_r($material_stock);

            // update data bahan 
            $url_mat = 'localhost:8000/api/material/'.$mat_id[$i];
            $trproduction->request('put', $url_mat, [
                'headers'=>['Content-type'=>'aplication/json'],
                'body'=>json_encode($edt_materials)
            ]);
        }

        $materials_final = json_encode($materials);

        $parameter = [
            'name'=> $name,
            'desc'=> $desc,
            'materials'=> $materials_final,
            'expired'=> $expired,
            'stock'=> $stock,
            // 'picture'=> $picture,
            'price'=> $price,
            'promo'=> $promo,
        ];
                
        $url = 'localhost:8000/api/trproduction';
        $reponse = $trproduction->request('post', $url, [
            'headers'=>['Content-type'=>'aplication/json'],
            'body'=>json_encode($parameter)
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('trproduction')->withErrors($error)->withInput();
        }else {
            return redirect()->to('trproduction')->with('success', 'berhasil menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tr_production  $tr_production
     * @return \Illuminate\Http\Response
     */
    public function show(Tr_production $tr_production)
    {
        //
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
    public function update(Request $request, Tr_production $tr_production)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tr_production  $tr_production
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tr_production $tr_production)
    {
        //
    }
}
