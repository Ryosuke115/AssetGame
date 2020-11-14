<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
    public function review(Request $request) {
    $assets = Account::all();
    $user_id = Auth::id();
    $name = Account::where('user_id', $user_id)->where('account_amount', '>=', 1)->pluck('asset_name');
    $account =  Account::where('user_id', $user_id)->where('account_amount', '>=', 1)->pluck('asset_number');
    $accounts = $account->all();//1コイン以上投資した資産口座の資産番号の配列
    $asset_name = $name->all();//1コイン以上投資した資産口座の名前の配列
        
        return view('market.market', ['assets' => $assets, 'accounts' => $accounts, 'asset_name' => $asset_name]);
    }
}
