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
                return redirect('login')->with('error', 'Invalided Username Or Password !');
            }
            
    }
    public function logout(){
        session()->flash('success','Logout was Successfully');
        session()->forget('user');
        return redirect('login');
    }
    public function register(){
        return view('backend.user.register');
    }
    public function save(Request $req){
        // $name = $req->name;
        // $username = $req->username;
        // $email = $req->email;
        // $password = md5($req->email);
        // echo $name .'</br>';
        // echo $username .'</br>' ;
        // echo  $email  .'</br>';
        // echo  $password ;
        try {
            $data = [
                'name' => $req->name,
                'username' => $req->username,
                'email' => $req->email,
                'password' => md5($req->password),
            ];
    
            DB::table('users')->insert($data);
            
            return redirect('register')->with('success', 'Registration successful!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Registration: ' . $e->getMessage());
        }
    } 
}

