<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

// Route for homepage
Route::get('/', [HomeController::class, 'homepage']);

// Routes for user registration
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Route for authenticated home
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// Route for login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Route for dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
