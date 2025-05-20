<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function welcome(){
        return view('home.welcome');
    }
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->role;

            if ($usertype == 'user') {
                return view('dashboard');
            } elseif ($usertype == 'admin') {
                return view('admin.index');
            } else {
                return redirect()->back();
            }
        }

        //return redirect('/login'); // Redirect users who are not logged in
    }

    public function homepage()
    {
        return view('home.homepage');
    }

    public function register()
    {
        return view('home.register');
    }
}
