<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Letter extends Model
{
    /*public function getBeaf() {
        var beafSum = DB::table('assets')->('id', 3)->value('asset_sum');
        
        return 
    }*/
    $user = Auth::id();//たぬきのidは2とする
    
    public function getTime() {
        $ppp = date('H:i:Y');
        return '今日は' . $ppp;
    }
    
    /*public function getBeaf() {
        $userstock = DB::table('users')->where('id', $user)->value('stock');
        $beaf = DB::table('assets')->where('name', '牛肉')->value('asset_sum');
        $beafid = DB::table('codes')->where('asset_id', 3)->pluck('user_id', $user);
        $beafsum = array_sum($beafid);
        //取得したレコード群は配列として格納される
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
        
        return $beafmsg . ':' .$beafcoin . 'コイン獲得しました';
    }*/
}
