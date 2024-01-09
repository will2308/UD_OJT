<?php

namespace App\Http\Controllers;

use App\Models\Tr_sale;
use App\Models\Tr_production;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cash = new Client();
        // $url = 'localhost:8000/api/cash';
        // $reponse = $cash->request('get', $url);
        // $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // $data = $gt_content['data'];
        // echo $gt_content;
        // print_r($data);
        // return view('content.main.home', ['data'=> $data]);
        return view('content.main.home');
    }

    public function dashboard()
    {
        $cash = new Client();
        $url = 'localhost:8000/api/cash';
        $reponse = $cash->request('get', $url);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        $data = $gt_content['data'];
        // print_r( $gt_content );
        // print_r($data);
        return view('content.admin.dashboard', ['data'=> $data]);
    }

    public function login(){
        return view('login');

    }

}
