<?php

namespace App\Http\Controllers;

use App\Models\Tr_buy;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class TrBuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trbuy = new Client();
        $url = 'localhost:8000/api/trbuy';
        $reponse = $trbuy->request('get', $url);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        $data = $gt_content['data'];

        $urlcat = 'localhost:8000/api/materialcategory';
        $reponsecat = $trbuy->request('get', $urlcat);
        $gt_category = json_decode($reponsecat->getBody()->getContents(), true);
        $category = $gt_category['data'];
        // echo $gt_content;
        // print_r($data);
        return view('content.admin.trbuy', ['data'=> $data, 'category'=> $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $mat_name = $req->materials_name;
        $mat_code = $req->materials_code;
        $mat_count = $req->materials_count;
        $mat_category = $req->materials_category;
        $mat_expired= $req->materials_expired;
        $mat_price = $req->materials_price;
        $datanih = [];
        for ($i=0; $i < count($mat_name); $i++) { 
            $data_materials = [
                'name' => $mat_name[$i],
                'code_material' => $mat_code[$i],
                'stock' => $mat_count[$i],
                'material_category' => $mat_category[$i],
                'expired' => $mat_expired[$i],
                'price' => $mat_price[$i],
            ];
            $datamentah = json_encode($data_materials);
            array_push($datanih,  $datamentah);
                //add mareial
            $trbuy = new Client();
            $url_mat = 'localhost:8000/api/material';
            $trbuy->request('post', $url_mat, [
                'headers'=>['Content-type'=>'aplication/json'],
                'body'=>json_encode($data_materials)
            ]);
        }
        
        // echo "<br>";
        // print_r($mat_name);

        $user = 1;
        $date = $req->date;
        $price = $req->price;
        $materials = json_encode($datanih);
        //$str = str_replace('\\', '', $materials);

        $parameter = [
            'user'=> $user,
            'materials'=> $materials,
            'date'=> $date,
            'price'=> $price,
        ];
        

        //print_r($parameter);
        echo str_replace('\\', '', json_encode($parameter));

        // // add pembelian
        $url = 'localhost:8000/api/trbuy';
        $reponse = $trbuy->request('post', $url, [
            'headers'=>['Content-type'=>'aplication/json'],
            'body'=>json_encode($parameter)
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
          
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('trbuy')->withErrors($error)->withInput();
        }else {
            return redirect()->to('trbuy')->with('success', 'berhasil menambah data');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tr_buy  $tr_buy
     * @return \Illuminate\Http\Response
     */
    public function show(Tr_buy $tr_buy)
    {
        //
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
    public function update(Request $request, Tr_buy $tr_buy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tr_buy  $tr_buy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tr_buy $tr_buy)
    {
        //
    }
}
