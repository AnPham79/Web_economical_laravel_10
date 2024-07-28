<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ThrottleViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        $productId = $request->route('product');

        $cacheKey = "product_detail_{$ip}_{$productId}";

        $views = Cache::get($cacheKey, 0);

        if($views >= 20)
        {
            return response()->json(['message', 'Có quá nhìu yêu cầu, vui lòng thử lại sau'], 429);
        }

        Cache::put($cacheKey, $views + 1, Carbon::now()->addMinutes(10));

        return $next($request);
    }
}
