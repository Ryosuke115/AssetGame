<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Code;
use App\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Checktime
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
        $now = date('D');
        $mon = "Mon";
        $thurs = "Thu";
        $beafcoin = 0;
        $beafmsg = 0;
        $beafid = array();
        $beafsum = array();
        $user = Auth::id();
        
        if ($now === $thurs || $now  === $mon) {
        $userstock = DB::table('users')->where('id', $user)->value('stock');
        $beaf = DB::table('assets')->where('name', '牛肉')->value('asset_sum');
        /*$beafid = DB::table('codes')->where([
            ['asset_number', '=', 3],
            ['user_id', '=', $user],
            ])->pluck('invest_amount');*/
        $beafid = DB::table('codes')->pluck('invest_amount');
        $beafsum = array_sum($beafid);//取得したレコード群は配列として格納される
        $beafcoin = 0;
        $beafmsg = '';
        
        if ($beaf < 50000) {
            $beafmsg = 'サチコ国では牛肉の安定的な生産体制を敷く計画を中断しました';
            $beafcoin = $beafsum * 0.2;
            $upstock = $beafcoin + $userstock;
            DB::table('users')->where('id', $users)->update(['stock'=>$upstock]);
        } else if ($beaf > 50001 && $beaf < 100000) {
            $beafmsg = "サチコ国は牛肉の安定的な生産体制を敷く計画に成功しました";
            $beafcoin = $beafsum * 0.4;
            $upstock = $beafcoin + $userstock;
            DB::table('users')->where('id', $users)->update(['stock'=>$upstock]);
        } else {
            $beafmsg = "大成功!大きな利益を出しました";
            $beafcoin = $beafsum * 2;
            $upstock = $beafcoin + $userstock;
            DB::table('users')->where('id', $users)->update(['stock'=>$upstock]);
        }
        
        //return $beafmsg . ':' .$beafcoin . 'コイン獲得しました';
        //return redirect('/code', ['bebe' => $beafcoin, 'upup' => $upstock]);
    }
        
        
        return $next($request);
    }
}
