<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index(){
        return view('backend.user.login');
        //  $sessions = session()->getid();
        //  echo $sessions;
    }
    public function dologin(Request $req){
        // testing Get Data
        // $username = $req->username;
        // $password = md5($req->password);
        // echo $password .'</br>';
        // echo $username;
        $username = $req->username;
        $password = md5($req->password);
        $data_user = DB::table('users')
            ->where('username', $username)
            ->where('password', $password)
            ->first();

            if ($data_user != null) {
                session(['user' => $data_user]); // Note the correct syntax for setting a session value
                return redirect('/')->with('success', "Login Successfully!!");
            } else {
                return redirect()->route('login')->withInput()->with('error', 'Invalided Username Or Password !');
            }
            
    }
}

