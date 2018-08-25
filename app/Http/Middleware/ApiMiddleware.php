<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Auth;
use Closure;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       // dd( Auth::guard('api')->user());

        //dd(str_random());
        return $next($request);
    }
}
