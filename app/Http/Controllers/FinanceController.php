<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function getStats(Request $request)
    {
        $range = $request->input('range', 'month');
        
        // 根據範圍設定日期 (這裡僅為範例)
        $startDate = match($range) {
            'today' => now()->startOfDay(),
            'week'  => now()->startOfWeek(),
            default => now()->startOfMonth(),
        };

        // 從資料庫抓取數據
        $stats = DB::table('revenues')
            ->where('created_at', '>=', $startDate)
            ->select(
                DB::raw('SUM(amount) as total'),
                DB::raw('SUM(fee) as fee'),
                DB::raw('SUM(payout) as payout')
            )
            ->first();

        return response()->json([
            'total_revenue' => $stats->total ?? 0,
            'fee' => $stats->fee ?? 0,
            'payout' => $stats->payout ?? 0
        ]);
    }
}