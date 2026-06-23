<?php

use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Esp32Controller;
use App\Http\Controllers\AdminController;

//login & register
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
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
    // 查詢以 'online:' 開頭的所有 Key
    $onlineUsers = \Illuminate\Support\Facades\Redis::command('keys', ['online:*']);

    return response()->json(['count' => count($onlineUsers)]);
});
Route::get('/sensors', [Esp32Controller::class, 'getSensorData']);
// Route::post('/feed', [Esp32Controller::class, 'triggerFeeding']);
// 允許一般使用者存取的路由
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AdminController::class, 'index'])->name('user.profile');
    Route::post('/profile/add-money', [AdminController::class, 'addMoney'])->name('user.add_money');
});

// 管理員專屬的路由 (保留給更高級的功能)
// 修改這裡：放寬 admin 權限檢查，改為在 Controller 內處理，避免 middleware 跳轉
// 將 /pump 的路由移出嚴格的 admin middleware
// 只保留 auth 以確保使用者已登入
Route::middleware(['auth'])->group(function () {
    Route::post('/pump', [Esp32Controller::class, 'controlPump'])->name('pump.control');
});
// routes/web.php

// 確保這行存在，且 name 是 'admin.add_money'
Route::post('/admin/add-money', [\App\Http\Controllers\AdminController::class, 'addMoney'])
    ->name('admin.add_money');
Route::post('/donate', [AdminController::class, 'donate'])->name('donate.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/api/finance-stats', [FinanceController::class, 'getStats']);
});