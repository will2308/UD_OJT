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
        $home = new Client();
        $url = 'localhost:8000/api/trproduction';
        $reponse = $home->request('get', $url);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        $data = $gt_content['data'];

        $urlpromo = 'localhost:8000/api/promo';
        $reponsepromo = $home->request('get', $urlpromo);
        $gt_promo = json_decode($reponsepromo->getBody()->getContents(), true);
        $promo = $gt_promo['data'];
        
        return view('content.main.home', ['data'=> $data, 'promo' => $promo]);
    }

    public function dashboard()
    {
        $dashboard = new Client();
        $url = 'localhost:8000/api/cash';
        $reponse = $dashboard->request('get', $url);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        $data = $gt_content['data'];

        return view('content.admin.dashboard', ['data'=> $data]);
    }

    public function login(){
        return view('login');

    }

}
