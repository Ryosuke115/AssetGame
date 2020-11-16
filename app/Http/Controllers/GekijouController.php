<?php

namespace App\Http\Controllers;

use App\Code;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GekijouController extends Controller
{
    //ホストの権限で入った時に、各Assetのasset_sumを集計し
    //イベントを起こす？
    //ホスト権限でアクセス->DBから集計->各イベント発生
    
    public function gekijou_view(Request $request) {
        $user = Auth::id();
        $stocks = DB::table('codes')->where('user_id', $user)->where('asset_number', 1)
            ->where('invest_amount', '>', 0)->get();
        
        $stock = $stocks->pluck('invest_amount');
        $values = $stock->all();//クエリから取ったDBデータはコレクションインスタンスなので配列に変更する
        $last = array_key_last($values);
        $sachiko_mikan = 0;
        
        for($i=0; $i<$last+1; $i++) {
            $ttt = $stock[$i];
            $sachiko_mikan += $ttt;
        }
        
        
        return view('gekijou.gekijou', [
                                         'stock' => $stock, 
                                        'sachiko_mikan' => $sachiko_mikan
                                        ]);
    }
}
+