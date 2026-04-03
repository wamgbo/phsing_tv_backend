<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // 務必引入加密工具
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('pages.result', compact('posts'));
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        // 2. 手動從資料庫抓出對應的 Post (User)
        $post = \App\Models\Post::where('username', $credentials['username'])->first();

        // 3. 檢查帳號是否存在，並手動比對 Hash 密碼
        if ($post && \Hash::check($credentials['password'], $post->password)) {

            // --- 驗證成功後的動作 ---

            // 手動把使用者資訊存入 Session (這就是登入的核心)
            session(['user_id' => $post->id]);
            session(['user_name' => $post->username]);

            // 重新產生 Session ID 防止攻擊
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', '登入成功！');
        }

        // 3. 失敗回傳錯誤
        return back()->withErrors([
            'username' => '帳號或密碼錯誤。',
        ]);
    }
    public function loginSubmit(Request $request)
    {
        $posts = $request->all();
        error_log(print_r($posts, true));
        Post::create([
            'username' => $posts['username'],
            'password' => Hash::make($posts['password']),
        ]);
        $temp = Post::index();
        error_log(print_r($temp, true));
        return view('pages.result', ['posts' => $posts]);
    }
    public function loginView()
    {
        return view('pages.login');
    }
    public function logout(Request $request)
    {
        $request->session()->flush();       // 清空所有資料
        $request->session()->invalidate();  // 讓 Session ID 失效
        $request->session()->regenerateToken(); // 重新產生 CSRF Token

        return redirect('/home')->with('success', '已成功登出！');
    }
}
