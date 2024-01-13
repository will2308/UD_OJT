<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

                $user = new Client();
                $url = 'localhost:8000/api/user';
                $reponse = $user->request('get', $url, [
                    'headers' => [ 'Authorization' => 'Bearer ' . $token ],
                ]);
                $gt_content = json_decode($reponse->getBody()->getContents(), true);
                $data = $gt_content['data'];
                // echo $gt_content;
                // print_r($data);
                return view('content.admin.user', ['data'=> $data]);
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
        $email = $req->email;
        $role = $req->role;
        $pic = $req->pic;
        $password = Hash::make($req->pasword);
        $desc = $req->desc;
        $parameter = [
            'name'=> $name,
            'email'=> $email,
            'role'=> $role,
            'pic'=> $pic,
            'password'=> $password,
            'desc'=> $desc,
        ];

        $user = new Client();
        $url = 'localhost:8000/api/user';
        $reponse = $user->request('post', $url, [
            'headers'=>[
                'Content-type'=>'aplication/json',
                'Authorization' => 'Bearer ' . $token
            ],
            'body'=>json_encode($parameter)
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // $data = $gt_content['data'];
        // echo $gt_content;
        // print_r($data);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('user')->withErrors($error)->withInput();
        }else {
            return redirect()->to('user')->with('success', 'berhasil menambah data');
        }
    }

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $req, $id)
    {
        $token =  session()->get('login_token');
        $name = $req->name;
        $email = $req->email;
        $role = $req->role;
        $pic = $req->pic;
        $password = Hash::make($req->pasword);
        $desc = $req->desc;
        $parameter = [
            'name'=> $name,
            'email'=> $email,
            'role'=> $role,
            'pic'=> $pic,
            'password'=> $password,
            'desc'=> $desc,
        ];

        $user = new Client();
        $url = 'localhost:8000/api/user/'.$id;
        $reponse = $user->request('put', $url, [
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
            return redirect()->to('user')->withErrors($error)->withInput();
        }else {
            return redirect()->to('user')->with('success', 'berhasil mengubah data');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id){
        $token =  session()->get('login_token');
        $user = new Client();
        $url = 'localhost:8000/api/user/'.$id;
        $reponse = $user->request('delete', $url, [
            'headers' => [ 'Authorization' => 'Bearer ' . $token ],
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('user')->withErrors($error)->withInput();
        }else {
            return redirect()->to('user')->with('success', 'berhasil menghapus data');
        }
    }
}
