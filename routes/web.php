<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

//home page
Route::match(['get', 'post'], '/', function () {
    return view('pages.home');
})->name('home');

//login & register
Route::get('/login', [AuthController::class, 'loginView'])->name('login.view');//get登入
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');//login驗證成功後的動作
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.submit');

Route::get('/register', function () {
    return view('pages.register');
})->name('register.view');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

//test page
route::match(['get', 'post'], '/temp', function () {
    return view('pages.temp');
});