<?php

namespace App\Http\Middleware;

use App\myHelper\helper;
use Closure;
use Illuminate\Support\Facades\Auth;

class isActiveAuth
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
        if(auth('web')->user()->activation == 0)
        {

            Auth::logout();
            return abort(401);
        }
        return $next($request);
    }
}
