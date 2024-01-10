<?php

namespace App\Http\Controllers;

use App\Models\Tr_sale;
use App\Models\Tr_production;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TrSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $product = new Client();
        // $url = 'localhost:8000/api/trproduction';
        // $reponse = $product->request('get', $url);
        // $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // $data = $gt_content['data'];
        // // echo $gt_content;
        // // print_r($data);
        // return view('content.main.home', ['data'=> $data]);
        return view('content.main.home');
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
        $customer = 1;
        $admin = 1;
        $promo = "";
        $date = date('Y-m-d H:i:s');
        $price = $req->price;
        $product_id = $req->product;
        $product_count = $req->product_count;
        $product = [];

        for ($i=0; $i < count($product_id); $i++) { 
            $data_product = [
                'id' => $product_id[$i],
                'count' => $product_count[$i],
            ];
            $dt_product = json_encode($data_product);
            array_push($product,  $dt_product);

            $trsale = new Client();

             // get data bahan 
             $url_get_prd = 'localhost:8000/api/trproduction/'.$product_id[$i];
             $reponse_get_prd = $trsale->request('get', $url_get_prd);
             $dt_prd = json_decode($reponse_get_prd->getBody()->getContents(), true);
             $prd = $dt_prd['data'];
 
             // inisiasi bahan 
             $product_name = $prd['name'];
             $product_desc = $prd['desc'];
             $product_materials = $prd['materials'];
             $product_promo = $prd['promo'];
             $product_expired = $prd['expired'];
             $product_price = $prd['price'];
             $product_picture = $prd['picture'];
             $product_stock = ( $prd['stock'] - $product_count[$i] ) ;
 
             $edt_products = [
                 "name" => $product_name,
                 "desc" => $product_desc,
                 "materials" => $product_materials,
                 "promo" => $product_promo,
                 "expired" => $product_expired,
                 "price" => $product_price,
                 "picture" => $product_picture,
                 "stock" => $product_stock,
             ];
 
             print_r($edt_products);
 
             // update data product 
            $url_mat = 'localhost:8000/api/trproduction/'.$product_id[$i];
            $trsale->request('put', $url_mat, [
                'headers'=>['Content-type'=>'aplication/json'],
                'body'=>json_encode($edt_products)
            ]);
        }

        $product_final = json_encode($product);


        $parameter = [
            'customer'=> $customer,
            'admin'=> $admin,
            'promo'=> $promo,
            'date'=> $date,
            'price'=> $price,
            'product'=> $product_final,
        ];

        $url = 'localhost:8000/api/trsale';
        $reponse = $trsale->request('post', $url, [
            'headers'=>['Content-type'=>'aplication/json'],
            'body'=>json_encode($parameter)
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // $data = $gt_content['data'];
        // echo $gt_content;
        // print_r($data);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('/')->withErrors($error)->withInput();
        }else {
            return redirect()->to('/')->with('success', 'berhasil menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tr_sale  $tr_sale
     * @return \Illuminate\Http\Response
     */
    public function show(Tr_sale $tr_sale)
    {
        //
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
    public function update(Request $request, Tr_sale $tr_sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tr_sale  $tr_sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tr_sale $tr_sale)
    {
        //
    }
}
