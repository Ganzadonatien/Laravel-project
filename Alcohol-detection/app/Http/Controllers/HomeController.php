<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'user')
             {
                return view('dashboard');
            }
             else if ($usertype == 'admin')
             {
                return view('admin.index');
            }
            else{
                return redirect()->back();
            }
        }
}

public function homepage(){
    return view('home.homepage');
}
}
