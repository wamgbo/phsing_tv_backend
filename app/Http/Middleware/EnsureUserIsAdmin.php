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
        // if (session('user_role') !== 'admin') {
        //     return redirect('/')->with('error', '您沒有存取權限。');
        // }
        return $next($request);
    }
}
