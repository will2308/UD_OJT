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
        // echo $gt_content;
        // print_r($data);
        return view('content.admin.trproduction', ['data'=> $data, 'materials'=> $materials]);
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
