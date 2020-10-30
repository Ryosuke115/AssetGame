<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Closure;

class SetPex
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
        if ($request->cookie('testX') == 5 ){
        $admi = $request->cookie('testX');
        $testX = $admi + 5;
        $response = response()->cookie('testX', $testX, 100);
        return $response;
        
        }else {
            $
            $pex += 5;
            Cookie::queue('test', $pex, 100);
        }
        
        return $next($request);
    }
}
