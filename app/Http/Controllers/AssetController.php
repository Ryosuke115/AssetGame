<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\Code;
use App\User;
use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    //ここに関数を用いてDBから値の取得をしたり、view()によるページの表示、切り替え、そしてDBへ値を保存、更新、削除ができる
    
    
    
    
    public function hostview(Request $request) {
        return view('asset.asset_form_host');
    }
    
    
    public function assetcreate(Request $request) {
        $this->validate($request, Asset::$rules);
        $country = $request->input('country');
        $asset_name = $request->input('asset_name');
        $asset_sum = $request->input('asset_sum');
       
        
        //$asset->fill($form)->save();
        DB::table('assets')
            ->insert(
                ['country' => $country, 'asset_name' => $asset_name, 'asset_sum' => $asset_sum]
        );
        
        return redirect('/asset/host');
    }
    
    
    public function asset_menu(Request $request) {
        return view('asset.asset_menu');
    }
    
    
    public function asset_invest_market(Request $request) {
        /*$asset = DB::table('assets')->pluck('asset_name');
        $asset_id = DB::table('assets')->pluck('id');
        $asset_number = $asset_id->all();
        $assets = $asset->all();*/
        $user_id = Auth::id();
        return view('market.asset_invest_market', [
                                                   'user_id' => $user_id,
                                                   
                                                  ]);
    }
    
    public function asset_codecreate(Request $request) {
        $this->validate($request, Code::$rules);
        $user_id = $request->input('user_id');
        $asset_number = $request->input('asset_number');
        $invest_amount = $request->input('invest_amount');
        $asset_name = DB::table('assets')->where('id', $asset_number)->value('asset_name');
        
        $record = Account::where('user_id', $user_id)//Accountテーブルから認証ユーザーの特定資産口座のカラムを格納
                  ->where('asset_number', $asset_number)->first();
        
        $stock_units = DB::table('assets')
            ->where('id', $asset_number)
            ->value('stock_units');
        
        DB::table('codes')
            ->insert(
              ['user_id' => $user_id, 'asset_number' => $asset_number, 'invest_amount' => $invest_amount]
        );
        
        DB::table('assets')
            ->where('id', $asset_number)
            ->increment('asset_sum', $invest_amount);
        
        if (!$record) {//そのユーザーの特定の資産の口座がまだ作成されていない場合、口座を作成する
        DB::table('accounts')
            ->insert(
            ['user_id' => $user_id, 
             'asset_number' => $asset_number, 
             'account_amount' => 0,
             'stock_unit' => $stock_units,
             'asset_name' => $asset_name
            ]
        );
    }
            
    
        DB::table('accounts')
            ->where('user_id', $user_id)
            ->where('asset_number', $asset_number)
            ->increment('account_amount', $invest_amount);
        
        return redirect('/asset/invest');
    }
    
    
    public function assets(Request $request) {
        return Asset::all();
    }
    
    public function selectAs(Request $request) {
        $select = $request->title;
        $selected = DB::table('assets')->where('asset_name', $select)
            ->value('issue_shares');
        $select_sum = DB::table('assets')->where('asset_name', $select)
            ->value('asset_sum');
        $select_name = DB::table('assets')->where('asset_name', $select)
            ->value('asset_name');
        $select_units = DB::table('assets')->where('asset_name', $select)
            ->value('stock_units');
        
        $asset_id = DB::table('assets')->where('asset_name', $select)
            ->value('id');
        $asset_ranking = DB::table('accounts')->where('asset_number', $asset_id)
            ->orderBy('account_amount', 'desc')->value('account_amount');
        
        $asset_rankid = DB::table('accounts')->where('asset_number', $asset_id)
            ->orderBy('account_amount', 'desc')->value('user_id');
        $asset_user = DB::table('users')->where('id', $asset_rankid)->value('name');
        
        return [$selected, $select_sum, $select_name, $select_units, $asset_ranking, $asset_user];
    }
}
