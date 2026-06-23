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

        // 用拼湊出來的 email 去資料庫比對
        $email = $credentials['username'] . '@temp.com';
        $user = \App\Models\User::where('email', $email)->first();

        if ($user && \Hash::check($credentials['password'], $user->password)) {
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role,
            ]);

            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', '登入成功！');
        }

        return back()->withErrors(['username' => '帳號或密碼錯誤。']);
    }

    // 註冊方法
    public function register(Request $request)
    {
        // 1. 驗證只留帳號與密碼
        $validatedData = $request->validate([
            'username' => 'required|string|unique:users,email', // 檢查帳號是否重複
            'password' => 'required|min:6|confirmed',
        ]);

        // 2. 建立使用者
        // 因為資料庫強制要求 email 欄位，我們手動用帳號拼湊一個假 email
        $user = \App\Models\User::create([
            'name' => $validatedData['username'], // 把帳號當作名稱
            'email' => $validatedData['username'] . '@temp.com', // 偽造一個 email 來滿足資料庫
            'password' => Hash::make($validatedData['password']),
            'role' => 'user',
        ]);

        // 3. 寫入 Session (請記得補上 role)
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role,
        ]);

        $request->session()->regenerate();

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
