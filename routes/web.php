<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});
Route::get('/posts', [PostController::class, 'index']);
Route::get('/temp', function () {
    return view('pages.temp');
});
route::addroute(['get', 'post'], '/temp', function () {
    return view('pages.temp');
});
Route::get('/login', [PostController::class, 'loginView'])->name('login.view');
Route::post('/login', [PostController::class, 'loginSubmit'])->name('login.submit');
// Route::post('/result', [PostController::class, 'result'])->name('result.view');



