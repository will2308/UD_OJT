<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        $token =  session()->get('login_token');
        if($token == null){
            return redirect()->to('login')->with('error', 'anda belum login');
        }
        
        else {
            if(session()->get('login_data')['role'] == 'customer'){
                return redirect()->to('')->with('error', 'anda bukan admin');
            } else {
           
                $dashboard = new Client();
                $url = 'localhost:8000/api/cash';
                $reponse = $dashboard->request('get', $url, [
                    'headers' => [ 'Authorization' => 'Bearer ' . $token ],
                ]);
                $gt_content = json_decode($reponse->getBody()->getContents(), true);
                $data = $gt_content['data'];

                return view('content.admin.dashboard', ['data'=> $data]);

            }

        
        }
        
    }

    public function login(){
        return view('login');
    }

    public function dologin(Request $req){
        $email = $req->email;
        $password = $req->password;
        $params = "email=".$email."&"."password=".$password;

        $login = new Client(['http_errors' => false]);
        $url = 'localhost:8000/api/dologin?'.$params;
        $reponse = $login->request('post', $url, [
            'headers'=>['Content-type'=>'aplication/json'],
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // print_r($gt_content);
        if($gt_content['status'] != true){
            $error = $gt_content['message'];
            return redirect()->to('login')->withErrors($error)->withInput();
        }else {
            session()->put('login_token',$gt_content['login_token']);
            session()->put('login_data',$gt_content['login_data']);
            $role = $gt_content['login_data']['role'];
            // print_r($auth_token);
            if ($role == "customer"){
                return redirect()->to('');
            } else {
                return redirect()->to('admin');
            }
        }
    }

    public function register(Request $req){
        $name = $req->name;
        $email = $req->email2;
        $role = "customer";
        $pic = $req->pic;
        $password = $req->pass2;
        $desc = $req->desc;
        $parameter = [
            'name'=> $name,
            'email'=> $email,
            'role'=> $role,
            'pic'=> $pic,
            'password'=> $password,
            'desc'=> $desc,
        ];

        // print_r($parameter);

        if($password == $req->pass3){           

            // print_r($parameter);
            $user = new Client();
            $url = 'localhost:8000/api/register';
            $reponse = $user->request('post', $url, [
                'headers'=>['Content-type'=>'aplication/json'],
                'body'=>json_encode($parameter)
            ]);
            $gt_content = json_decode($reponse->getBody()->getContents(), true);
            if($gt_content['status'] != true){
                $error = $gt_content['data'];
                return redirect()->to('login')->withErrors($error)->withInput();
            }else {
                return redirect()->to('login')->with('success', 'berhasil mendaftarkan diri');
            }
        }else {
            return redirect()->to('login')->with('error', 'password tidak sama');
        }
    }

    public function logout(){
        Session::flush();
        $logout = new Client();
        $url = 'localhost:8000/api/dologout';
        $reponse = $logout->request('post', $url, [
            'headers'=>['Content-type'=>'aplication/json'],
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);     

        return redirect()->to('login');

    }

}
