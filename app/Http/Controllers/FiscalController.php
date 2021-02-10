<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Code;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datetime;
use DateTimeZone;

class FiscalController extends Controller
{
    public function dividend_view(Request $request) {
        $jst_time = new Datetime();
        $jst_time->setTimeZone(new DateTimeZone('Asia/Tokyo'));
        $after = new Datetime('2020/01/09 12:12:12');
        $haitou = 0;
        $user_id = Auth::id();
        //決算日当日の資産の名前
        $dividend = Asset::where('fiscal_period', '<=', $jst_time)
                           ->pluck('asset_name');
        $dividend_asset = $dividend->all();
        
        $divid = Asset::where('fiscal_period', '<=', $jst_time)
                           ->pluck('id');
        $dividend_id = $divid->all();
        
        //今日決算日である資産のコードを持っているかどう
        $dividend_code = Code::where('fiscal_period', '<=', $jst_time)//本日決算
                    ->where('user_id', $user_id)//認証ユーザのidであるCODE
                    ->where('already', 0)//でまだ決算処理を行っていないコード
                    ->get();//が存在するかどうか
        
        //配列への変換
        $dividend_codes = $dividend_code->all();

        return view('fiscal.dividend', ['jst_time' => $jst_time, 
                                        'after' => $after, 
                                        'dividend_asset' => $dividend_asset, 
                                        'dividend_codes' => $dividend_codes]);
    }
    //post送信による配当の受け取り    
    public function dividend_end(Request $request) {
        $jst_time = new Datetime();
        $jst_time->setTimeZone(new DateTimeZone('Asia/Tokyo'));//日本現行時間取得
        $after = new Datetime('2020/01/09 12:12:12');//例
        $user_id = Auth::id();//認証ユーザid
        $dividend = Asset::where('fiscal_period', '<=', $jst_time)
                           ->pluck('id');//当日決算の資産のid
        $dividend_asset = $dividend->all();//配列へ変換
        
        foreach($dividend_asset as $value) {//配当を受け取ったcodeに済をサインする
            DB::table('codes')
                ->where('user_id', $user_id)
                ->where('asset_number', $value)
                ->where('fiscal_period', '<=', $jst_time)
                ->update(['already' => 1]);
        }
        return redirect('dividend');
    }
}
