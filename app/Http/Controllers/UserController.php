<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getUserStats()
    {
        // 假設我們有 User 模型，或者直接使用 DB::table
        $totalUsers = \App\Models\User::count();

        // 計算增長率 (這裡僅為邏輯範例，建議在資料庫做快照或複雜查詢)
        $growth = 12.5; // 假設值

        return response()->json([
            'total' => $totalUsers,
            'growth' => $growth
        ]);
    }
}
