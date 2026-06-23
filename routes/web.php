<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Esp32Controller;

//login & register
Route::get('/login', [AuthController::class, 'loginView'])->name('login.view');//get登入
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');//login驗證成功後的動作
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
//home page
Route::match(['get', 'post'], '/', function () {
    return view('pages.home');
})->name('home');
//pages
Route::get('/vscode', function () {
    return view('pages.vscode');
})->name('vscode');
Route::get('/register', function () {
    return view('pages.register');
})->name('register.view');
Route::get('/stream', function () {
    return view('pages.stream');
})->name('stream.view');
Route::get('/manage', function () {
    return view('pages.manage');
})->name('manage.view');
Route::get('/admin', function () {
    return view('pages.admin');
})->name('admin.view');
Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile.view');

//test page
Route::match(['get', 'post'], '/temp', function () {
    return view('pages.temp');
});


// 獲取最新訊息
Route::get('/api/messages', function () {
    return Message::orderBy('created_at', 'asc')->take(50)->get();
})->name('messages.get');

// 儲存新訊息
Route::post('/api/messages', function (Request $request) {
    $msg = new Message();
    // 如果有登入就用 session 的名字，否則用「訪客」
    $msg->user_name = session('user_name') ?? '訪客';
    $msg->user_id = session('user_id');
    $msg->content = $request->content;
    $msg->save();

    return response()->json(['status' => 'success']);
})->name('messages.store');
Route::get('/api/online-count', function () {
    // 透過 Redis 的 keys 掃描所有以 user-is-online 開頭的 key
    $onlineUsers = Redis::keys('laravel_database_user-is-online-*');
    return response()->json(['count' => count($onlineUsers)]);
});
Route::get('/sensors', [Esp32Controller::class, 'getSensorData']);
Route::post('/pump', [Esp32Controller::class, 'controlPump']);
Route::post('/feed', [Esp32Controller::class, 'triggerFeeding']);