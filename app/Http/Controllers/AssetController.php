<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
}
