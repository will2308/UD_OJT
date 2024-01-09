<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo = new Client();
        $url = 'localhost:8000/api/promo';
        $reponse = $promo->request('get', $url);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        $data = $gt_content['data'];
        // echo $gt_content;
        // print_r($data);
        return view('content.admin.promo', ['data'=> $data]);
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
        $name = $req->name;
        $desc = json_encode(array('desc' => $req->desc, "promo" => $req->promo));

        $parameter = [
            'name'=> $name,
            'desc'=> $desc,
        ];

        $promo = new Client();
        $url = 'localhost:8000/api/promo';
        $reponse = $promo->request('post', $url, [
            'headers'=>['Content-type'=>'aplication/json'],
            'body'=>json_encode($parameter)
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // $data = $gt_content['data'];
        // echo $gt_content;
        // print_r($data);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('promo')->withErrors($error)->withInput();
        }else {
            return redirect()->to('promo')->with('success', 'berhasil menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo, Request $req, $id)
    {
        $name = $req->name;
        $desc = json_encode(array('desc' => $req->desc, "promo" => $req->promo));
        $parameter = [
            'name'=> $name,
            'desc'=> $desc,
        ];

        $promo = new Client();
        $url = 'localhost:8000/api/promo/'.$id;
        $reponse = $promo->request('put', $url, [
            'headers'=>['Content-type'=>'aplication/json'],
            'body'=>json_encode($parameter)
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('promo')->withErrors($error)->withInput();
        }else {
            return redirect()->to('promo')->with('success', 'berhasil mengubah data');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promo $promo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo, $id)
    {
        $promo = new Client();
        $url = 'localhost:8000/api/promo/'.$id;
        $reponse = $promo->request('delete', $url);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('promo')->withErrors($error)->withInput();
        }else {
            return redirect()->to('promo')->with('success', 'berhasil menghapus data');
        }
    }
}
