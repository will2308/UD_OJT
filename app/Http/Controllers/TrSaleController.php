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
    public function store(Request $request)
    {
        //
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
