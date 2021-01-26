<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Account;
use App\Market;
use App\Http\Controllers\MarketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class MarketController extends Controller
{
    public function review(Request $request) {
        $error = '';
    $assets = Account::all();
    $user_id = Auth::id();
    $name = Account::where('user_id', $user_id)->where('account_amount', '>=', 1)->pluck('asset_name');
    $account =  Account::where('user_id', $user_id)->where('account_amount', '>=', 1)->pluck('asset_number');
    $accounts = $account->all();//1コイン以上投資した資産口座の資産番号の配列
    $asset_name = $name->all();//1コイン以上投資した資産口座の名前の配列
        
        return view('market.market', ['assets' => $assets, 'accounts' => $accounts, 'asset_name' => $asset_name, 'user_id' => $user_id, 
                                      'error' => $error]);
    }
    
    
    public function market_to(Request $request) {
        
        $trade_type = $request->input('buy_sell');
        $user_id = $request->input('user_id');
        $asset_number = $request->input('market_asset');
        $asset_amount = Account::where('user_id', $user_id)->where('asset_number', $asset_number)->value('account_amount');
        $transact = $request->input('transaction');
        
        $buy = Market::where('asset_number', $asset_number)//現市場の最高値の買い注文
               ->where('trade_type', 0)
               ->orderBy('transact_amount', 'desc')
               ->value('transact_amount');
        
        $sell = Market::where('asset_number', $asset_number)//現行市場の最安値売り
                      ->where('trade_type', 1)
                      ->orderBy('transact_amount', 'asc')
                      ->value('transact_amount');
        
        
        if ($trade_type == 1 && $transact <= $asset_amount) {
            //注文タイプが売りであり、取引数量が口座内のその資産の数量を下回っていれば

           if ($transact < $sell) {//売り注文数量が現行市場で最安値だった時即成立させる
               $buy_id = Market::where('asset_number', $asset_number)//最高値注文id
                          ->where('trade_type', 0)
                          ->orderBy('transact_amount', 'desc')
                          ->value('id');
               
               DB::table('accounts')//口座を示すaccountsテーブルの保有数量を減少させる
                    ->where('user_id', $user_id)
                    ->where('asset_number', $asset_number)
                    ->decrement('account_amount', $transact);
               
               DB::table('users')->where('id', $user_id)->increment('stock', $buy);
               DB::table('markets')->where('id', $buy_id)->delete();
               
               return redirect('/market');
           }else{//取引成立保留
        DB::table('markets')->insert([//marketsテーブルに注文データを保存する
            'user_id' =>  $user_id,
            'asset_number' => $asset_number,
            'trade_type' => $trade_type,
            'transact_amount' => $transact
        ]);
        
        DB::table('accounts')//口座を示すaccountsテーブルの保有数量を減少させる
            ->where('user_id', $user_id)
            ->where('asset_number', $asset_number)
            ->decrement('account_amount', $transact);
        
        return redirect('/market');
           }
        } elseif ($trade_type == 0) {//注文タイプが買いの場合
           
            if ($transact > $buy) {//買い注文数量が現行市場で最高値の時即成立
                $sell_id = Market::where('asset_number', $asset_number)
                           ->where('trade_type', 1)
                           ->orderBy('transact_amount', 'asc')
                           ->value('id');
                
                $account_isset = Account::where('user_id', $user_id)
                                  ->where('asset_number', $asset_number)
                                  ->first();
                
                if (isset($account_isset)) {//口座に買った枚数分挿入する
                DB::table('accounts')->where('user_id', $user_id)
                           ->where('asset_number', $asset_number)
                           ->increment('account_amount', $buy);
                    
                DB::table('markets')->where('id', $sell_id)->delete();
                    return redirect('/market');
                    
                } else {
                    $stock_unit = Asset::where('id', $asset_number)
                                  ->value('stock_unit');
                    
                    $asset_name = Asset::where('id', $asset_name)
                                  ->value('asset_name');
                    
                    DB::table('accounts')->insert([
                        'user_id' => $user_id,
                        'asset_number' => $asset_number,
                        'account_amount' => $buy,
                        'stock_unit' => $stock_unit,
                        'asset_name' => $asset_name
                    ]);
                    DB::table('markets')->where('id', $sell_id)->delete();
                    return redirect('/market');
                }
            }else {//取引成立保留
            DB::table('markets')->insert([
                'user_id' => $user_id,
                'asset_number' => $asset_number,
                'trade_type' => $trade_type,
                'transact_amount' => $transact
            ]);
            
           return redirect('/market');
            }
        } elseif ($trade_type == 2){//成行買い注文の場合、最安値の売りと即成立させる
            $nariyuki_kai = Market::where('asset_number', $asset_number)
                            ->where('trade_type', 1)
                            ->orderBy('transact_amount', 'asc')
                            ->value('transact_amount');
            
            $nariyuki_id = Market::where('asset_number', $asset_number)
                            ->where('trade_type', 1)
                            ->orderBy('transact_amount', 'asc')
                            ->value('id');
            
            DB::table('accounts')->where('asset_number', $asset_number)
                                 ->where('user_id', $user_id)
                                 ->increment('account_amount', $nariyuki_kai);

            return redirect('/market');
            
        }else{
            $error = "手持ちの当該資産投資券が希望売り枚数を満たしていなかったため注文は無効となりました";
            $user_id = Auth::id();
            return view('market.market', ['error' => $error, 'user_id' => $user_id]);
        }
    }
    
    
    
    public function assets(Request $request) {
        return Asset::all();
    }
    
    public function marketStatus(Request $request) {
        $select = $request->asset_select;
        $select_name = DB::table('assets')->where('asset_name', $select)
                  ->value('asset_name');
        $select_sum = DB::table('assets')->where('asset_name', $select)
                  ->value('asset_sum');
        $high_trade = DB::table('assets')->where('asset_name', $select)
                  ->value('high_price');
        $low_trade = DB::table('assets')->where('asset_name', $select)
                  ->value('low_price');
        return [$select_name, $select_sum, $high_trade, $low_trade];
    }
}
