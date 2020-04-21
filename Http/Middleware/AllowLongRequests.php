<?php


namespace Ecjia\Kernel\Http\Middleware;


use Closure;

class AllowLongRequests
{

    public function handler($request, Closure $next)
    {
        set_time_limit(3000);

        return $next($request);
    }

}