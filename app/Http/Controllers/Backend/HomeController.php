<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        if (session('user') == null) {
            return redirect('login');
       }
        return view('backend.dashboard.index');
    }
}
