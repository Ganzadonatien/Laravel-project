<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[HomeController::class, 'homepage']);

route::get('/home', [HomeController::class,'index'])->middleware('auth')->name('home');
