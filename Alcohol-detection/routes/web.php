<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;

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





Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/devices', [DeviceController::class, 'index'])->name('admin.devices.index');
    Route::get('/devices/create', [DeviceController::class, 'create'])->name('admin.devices.create');
    Route::post('/devices', [DeviceController::class, 'store'])->name('admin.devices.store');
    Route::get('/devices/{device}/edit', [DeviceController::class, 'edit'])->name('admin.devices.edit');
    Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('admin.devices.update');
    Route::delete('/devices/{device}', [DeviceController::class, 'destroy'])->name('admin.devices.destroy');
});



Route::middleware(['auth'])->prefix('admin')->group(function () {
    // ... devices routes

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});
