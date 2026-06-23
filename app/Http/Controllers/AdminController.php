<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // 取得目前登入者的資料
        $user = User::find(session('user_id'));

        return view('pages.admin', [
            'user' => $user
        ]);
    }

    public function addMoney(Request $request)
    {
        $user = User::find(session('user_id'));

        // 增加 100 元
        $user->balance += 100;
        $user->save();

        return back()->with('success', '已成功加值 100 元！');
    }
    // app/Http/Controllers/AdminController.php

    public function donate(Request $request)
    {
        // 手動判斷是否登入
        if (!session()->has('user_id')) {
            return redirect()->route('login.view')->with('error', '請先登入才能斗內！');
        }
        // 1. 驗證金額
        $request->validate(['amount' => 'required|numeric|min:1']);

        // 2. 獲取當前登入者
        $sender = \App\Models\User::find(session('user_id'));

        // 3. 扣款與轉帳邏輯
        $amount = $request->input('amount');

        if ($sender->balance < $amount) {
            return back()->with('error', '餘額不足！');
        }

        $sender->decrement('balance', $amount);

        // 假設管理員/目標 ID 為 1
        $receiver = \App\Models\User::find(1);
        if ($receiver) {
            $receiver->increment('balance', $amount);
        }

        return back()->with('success', '斗內成功，感謝支持！');
    }
}