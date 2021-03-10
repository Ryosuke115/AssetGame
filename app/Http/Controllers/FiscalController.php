<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Code;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datetime;
use DateTimeZone;


//認証ユーザーが保有している配当受け取り日を迎えた投資券を精算して、配当コインを渡していくコントローラ
class FiscalController extends Controller
{
    public function dividend_view(Request $request) {
        $jst_time = new Datetime();
        $jst_time->setTimeZone(new DateTimeZone('Asia/Tokyo'));　　　　  //取得した現在日時をJST時刻に変換させる
        $after = new Datetime('2020/01/09 12:12:12');                  //サンプルデータ
        $user_id = Auth::id();                                         //認証ユーザID
        $dividend = Asset::where('fiscal_period', '<=', $jst_time)     //認証ユーザIDから決算期日がJST現在時刻を超えている投資券の名前をコレクションで取得
                           ->pluck('asset_name');                
        $dividend_asset = $dividend->all();                            //上記のコレクションを配列に変換、foreach()で表示するために
        
        $divid = Asset::where('fiscal_period', '<=', $jst_time)        //認証ユーザIDから決算期日がJST現在時刻を超えている投資券のIDをコレクションで取得
                           ->pluck('id'); 
        $dividend_id = $divid->all();                                  //上記のコレクションを配列に変換
        
        　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　   //アクセス時に決算日である資産のコードを持っているかどうかの振り分けを行うクエリ
        $dividend_code = Code::where('fiscal_period', '<=', $jst_time) //本日または、決算期日を超えている
                    ->where('user_id', $user_id)                       //認証ユーザのidである
                    ->where('already', 0)                              //まだ決算処理を行っていない注文
                    ->get();　　　　　　　　　　　　　　　　　　　　　　　　　 //が存在するかどうか
        
                                                                    
        $dividend_codes = $dividend_code->all();                       //上記を配列への変換
        
                                                                       //配当完了、決算日付の更新
        $update = Asset::where('fiscal_period', '<=', $jst_time)       //設定された決算日を迎え、配当を終えた資産の決算日を取得する
                           ->value('fiscal_period');
        $updates = new DateTime($update);　　　　　　　　　　　　　　　　　　//上記で取得した決算日をDATETIME型に変換
        $update_second = new DateTime($update);                        //決算更新日を作成するにあたり必要なため二つ目を用意
        $updates->setTimeZone(new DateTimeZone('Asia/Tokyo'));         //JSTへの変換
        $update_second->setTimeZone(new DateTimeZone('Asia/Tokyo'));   //上に同じ
        $neo_update = $updates->modify('+1 day');                      //一つ目の$updatesに+1日する
        $update_day = $update_second->modify('+5 day');　　　　　　　　　 //二つ目の$update_secondには+5日する
        
        if($jst_time >= $update) {                                     //決算日がJST時刻を超えていた場合
                DB::table('assets')->where('fiscal_period', '<', $neo_update)     //Assetモデルの決算日がJSTを一日超えていないモデルの
                                   ->update(['fiscal_period' => $update_day]);    //決算日を5日後に更新する
        }

        return view('fiscal.dividend', ['jst_time' => $jst_time,       //配当受け取りページの表示
                                        'after' => $after, 
                                        'dividend_asset' => $dividend_asset, 
                                        'dividend_codes' => $dividend_codes,
                                        'update' => $neo_update,
                                       ]);
    }
    //post送信による配当の受け取り    
    public function dividend_end(Request $request) {
        $jst_time = new Datetime();
        $jst_time->setTimeZone(new DateTimeZone('Asia/Tokyo'));        //日本現行時間取得
        $after = new Datetime('2020/01/09 12:12:12');                  //サンプル
        $user_id = Auth::id();                                         //認証ユーザid
        $dividend = Asset::where('fiscal_period', '<=', $jst_time)
                           ->pluck('id');                              //当日決算の資産のid
        $dividend_asset = $dividend->all();                            //配列へ変換
        
        foreach($dividend_asset as $value) {                           //配当を受け取ったcodeに完了済をサインする
            DB::table('codes')
                ->where('user_id', $user_id)
                ->where('asset_number', $value)
                ->where('fiscal_period', '<=', $jst_time)
                ->update(['already' => 1]);
        }
        return redirect('dividend');
    }
}
