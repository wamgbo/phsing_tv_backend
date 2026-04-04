<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // 務必引入加密工具
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{


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

    //register
    public function register(Request $request)
    {
        // 1. 驗證資料
        $validatedData = $request->validate([
            'username' => 'required|unique:posts,username',
            'password' => 'required|min:6|confirmed',
        ]);

        // 2. !! 重要 !! 必須手動加密密碼
        // 如果不加密，資料庫會存明文，Hash::check 會永遠失敗
        $user = Post::create([
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // 3. !! 重要 !! 為了配合你首頁導覽列的判斷邏輯
        // 你必須手動寫入 Session，否則首頁會顯示「請登入」
        session([
            'user_id'   => $user->id,
            'user_name' => $user->username,
        ]);

        $request->session()->regenerate();

        // 4. !! 重要 !! 改用 redirect 轉發
        // return view 只是把畫面渲染出來，網址不會變，且容易造成重複提交 (F5 重新整理)
        return redirect()->route('home')->with('success', '註冊成功！');
    }
    //return view
    public function loginView()
    {
        return view('pages.login');
    }
    //logout
    public function logout(Request $request)
    {
        $request->session()->flush();       // 清空所有資料
        $request->session()->invalidate();  // 讓 Session ID 失效
        $request->session()->regenerateToken(); // 重新產生 CSRF Token

        return redirect(route('home'))->with('success', '已成功登出！');
    }
}
