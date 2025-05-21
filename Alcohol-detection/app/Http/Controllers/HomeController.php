<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AlcoholRecord;
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





    public function index1()
{
    $user = Auth::user();

    $records = AlcoholRecord::where('user_id', $user->id)->orderBy('tested_at')->get();

    $dates = $records->pluck('tested_at')->map(function ($date) {
        return $date->format('d M Y');
    });

    $levels = $records->pluck('alcohol_level');

    return view('dashboard', compact('dates', 'levels'));
}

public function destroy(Request $request)
{
    $user = $request->user();
    $user->delete();

    return redirect('/')->with('status', 'Your account has been deleted.');
}
}
