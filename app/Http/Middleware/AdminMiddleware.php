<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem session 'role' có tồn tại và có giá trị bằng 0 hay không
        if(session()->has('role') && session()->get('role') == 0)
        {
            return $next($request); // Nếu có, tiếp tục xử lý request
        }

        return redirect()->route('index');
    }
}
