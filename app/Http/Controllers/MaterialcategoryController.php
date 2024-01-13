<?php

namespace App\Http\Controllers;

use App\Models\Materialcategory;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MaterialcategoryController extends Controller
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
        }
        
        else {
            if(session()->get('login_data')['role'] == 'customer'){
                return redirect()->to('')->with('error', 'anda bukan admin');
            } else {
        
                $kategori = new Client();
                $url = 'localhost:8000/api/materialcategory';
                $reponse = $kategori->request('get', $url, [
                    'headers' => [ 'Authorization' => 'Bearer ' . $token ],
                ]);
                $gt_content = json_decode($reponse->getBody()->getContents(), true);
                $data = $gt_content['data'];
                // echo $gt_content;
                // print_r($data);
                return view('content.admin.kategori', ['data'=> $data]);
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
        $desc = $req->desc;
        $parameter = [
            'name'=> $name,
            'desc'=> $desc,
        ];

        $kategori = new Client();
        $url = 'localhost:8000/api/materialcategory';
        $reponse = $kategori->request('post', $url, [
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
            return redirect()->to('kategori')->withErrors($error)->withInput();
        }else {
            return redirect()->to('kategori')->with('success', 'berhasil menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materialcategory  $materialcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Materialcategory $materialcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materialcategory  $materialcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Materialcategory $materialcategory, Request $req, $id)
    {
        $token =  session()->get('login_token');
        $name = $req->name;
        $desc = $req->desc;
        $parameter = [
            'name'=> $name,
            'desc'=> $desc
        ];

        $kategori = new Client();
        $url = 'localhost:8000/api/materialcategory/'.$id;
        $reponse = $kategori->request('put', $url, [
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
            return redirect()->to('kategori')->withErrors($error)->withInput();
        }else {
            return redirect()->to('kategori')->with('success', 'berhasil mengubah data');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materialcategory  $materialcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        // echo "hello word";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materialcategory  $materialcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materialcategory $materialcategory, $id)
    {
        $token =  session()->get('login_token');
        $kategori = new Client();
        $url = 'localhost:8000/api/materialcategory/'.$id;
        $reponse = $kategori->request('delete', $url, [
            'headers' => [ 'Authorization' => 'Bearer ' . $token ],
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('kategori')->withErrors($error)->withInput();
        }else {
            return redirect()->to('kategori')->with('success', 'berhasil menghapus data');
        }
    }
}
