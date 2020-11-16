<?php

namespace App\Http\Controllers;

use App\Account;
use App\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class MarketController extends Controller
{
    public function review(Request $request) {
    $assets = Account::all();
    $user_id = Auth::id();
    $name = Account::where('user_id', $user_id)->where('account_amount', '>=', 1)->pluck('asset_name');
    $account =  Account::where('user_id', $user_id)->where('account_amount', '>=', 1)->pluck('asset_number');
    $accounts = $account->all();//1コイン以上投資した資産口座の資産番号の配列
    $asset_name = $name->all();//1コイン以上投資した資産口座の名前の配列
        
        return view('market.market', ['assets' => $assets, 'accounts' => $accounts, 'asset_name' => $asset_name, 'user_id' => $user_id]);
    }
    
    
    public function market_to(Request $request) {
        
        $trade_type = $request->input('buy_sell');
        $user_id = $request->input('user_id');
        $asset_number = $request->input('market_asset');
        $asset_amount = Account::where('user_id', $user_id)->where('asset_number', $asset_number)->value('account_amount');
        $transact = $request->input('transaction');
        
        if ($transact <= $asset_amount) {
        
        /*$this->validate($request, Market::$rules);
        $market = new Market;
        $form = $request->all();
        unset($form['_token']);
        $market->fill($form)->save(); */
            
        DB::table('markets')->insert([
            'user_id' =>  $user_id,
            'asset_number' => $asset_number,
            'trade_type' => $trade_type,
            'transact_amount' => $transact
        ]);
        
        if ($trade_type == 1) {
        DB::table('accounts')
            ->where('user_id', $user_id)
            ->where('asset_number', $asset_number)
            ->decrement('account_amount', $transact);
        }
        return redirect('/market');
        
        } else {
            return redirect('/code');
        } 
    }
}
