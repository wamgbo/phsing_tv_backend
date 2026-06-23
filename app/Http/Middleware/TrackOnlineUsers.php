<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class TrackOnlineUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    // app/Http/Middleware/TrackOnlineUsers.php

    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $key = 'online:' . $ip; // 改用簡單的 'online:' 開頭

        // 直接操作 Redis，存入該 Key，設定 60 秒過期
        Redis::setex($key, 60, 'true');

        return $next($request);
    }
}
