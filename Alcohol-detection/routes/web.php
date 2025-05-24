<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/register', function () {
    return view('home.register');
})->name('register');
Route::get('/', [HomeController::class, 'welcome']);
Route::get('/home', [HomeController::class, 'homepage'])->name('home');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth');
Route::get('/download-report/{period}', [HomeController::class, 'downloadReport'])->name('report.download');



Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [HomeController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [HomeController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [HomeController::class, 'destroy'])->name('profile.delete');
});



Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');
