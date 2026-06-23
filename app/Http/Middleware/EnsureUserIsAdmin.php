<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // 如果 Session 裡沒資料，紀錄錯誤
        if (!session()->has('user_id')) {
            \Log::error('Admin Middleware: Session user_id 不存在，導向登入');
        }

        return $next($request);
    }
}
