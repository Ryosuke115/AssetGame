<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Closure;

class PlusPex
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
        return $next($request);
        
        //リクエスト後
        $roro = $request->cookie('testX');//Cookie::get('testX');
        $koko = $request->cookie('testY');//Cookie::get('testY');
        $gogo = $roro += 5;
        $response = reponse()->cookie('testX', $gogo, 100);//Cookie::queue('testX', $gogo, 100);
        $response->cookie('pastX', $roro, 100);//Cookie::queue('pastX', $roro, 100);
        $response->cookie('pastY', $koko, 100);//Cookie::queue('pastY', $koko, 100);
        
        return $response;
    }
}
