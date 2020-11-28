<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
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
        $asset = DB::table('assets')->pluck('asset_name');
        $assets = $asset->all();
        $user_id = Auth::id();
        return view('market.asset_invest_market', ['assets' => $assets,
                                                   'user_id' => $user_id]);
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
        return [$selected ,$select_sum];
    }
}
