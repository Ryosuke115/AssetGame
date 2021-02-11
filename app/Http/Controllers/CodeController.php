<?php

namespace App\Http\Controllers;

use App\Code;
use App\Asset;
use App\User;
use App\Account;
use App\Market;
use App\Http\Controllers\Controller;
use Datetime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Services\Util;

class CodeController extends Controller
{
    public function index(Request $request, Util $util) {
        $userid = Auth::id();
        $items = Code::all();
        //$pinn = User::all();
        $pinn = date('D');
        $beaff = DB::table('codes')->pluck('invest_amount');
        //$bee = Code::where('invest_amount', '10000')
                  //->get();
        $values = $beaff->all();//配列に変換
        $last = array_key_last($values);
        $beaf = 0;
        $buy_sec = Market::where('asset_number', 3)
               ->where('trade_type', 0)
               ->orderBy('transact_amount', 'desc')
               ->pluck('transact_amount');
        $buy = $buy_sec->all();
        
        $date = new Datetime();
        $date->setTimeZone(new DateTimeZone('Asia/Tokyo'));
        $date->modify('+1 weeks');
        
        
        
        for($i=0; $i<$last+1; $i++) {
            
            //aa = $i + 1;
            $rrr = $beaff[$i];// + $beaff[$aa];
            $beaf += $rrr;
        }
        
        
        //$beaf = $beaff[0] + $beaff[1];
        $bee = 0;
        $bea = $beaff[1];
        $utin = $util->getMessage();
        
        $time = Code::where('user_id', 2)->where('asset_number', 1)->value('invest_amount');
        
        return view('code.index', ['items' => $items, 'pin' => $pinn, 'beaf' => $beaf, 'beaff' => $beaff, 'bee' => $bee, 'beal' => $bea, 'last' => $last, 'time' => $time, 'buy' => $buy, 'date' => $date, 'utin' => $utin]);
        
        
    }
 
    
    
    public function add(Request $request) {
        return view('code.add');
    }
    
    public function ate(Request $request) {
        $this->validate($request, Code::$rules);
        $code = new Code;
        $form = $request->all();
        unset($form['_token']);
        $code->fill($form)->save();
        return redirect('/code');
    }
    
    
    public function codeview(Request $request) {
        $id = Auth::id();
        return view('code.form_code', ['prove_user' => $id]);
        //渡した先のviewページで$prove_userとして使える
    }
    
    public function codecreate(Request $request) {
        $this->validate($request, Code::$rules);
        $user_id = $request->input('user_id');
        $asset_number = $request->input('asset_number');        
        $invest_amount = $request->input('invest_amount');
        $asset_name = DB::table('assets')->where('id', $asset_number)->value('asset_name');
        $fiscal_period = Asset::where('id', $asset_number)
             ->value('fiscal_period');
        
        $record = Account::where('user_id', $user_id)//Accountテーブルから認証ユーザーの特定資産口座のカラムを格納
                  ->where('asset_number', $asset_number)->first();
        
        $stock_units = DB::table('assets')
            ->where('id', $asset_number)
            ->value('stock_units');
        
        DB::table('codes')
            ->insert(
              ['user_id' => $user_id, 'asset_number' => $asset_number, 'invest_amount' => $invest_amount, 'fiscal_period' => $fiscal_period]
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
        
        return redirect('/code/form');
    }
    
    
    
    public function mikan_view(Request $request){
        $id = Auth::id();
        return view('asset.sachiko.mikan', ['prove_user' => $id]);
    }
    
    
    
    public function mikan_stock(Request $request) {
        $this->validate($request, Code::$rules);
        $userno_id = $request->input('user_id');
        $mikan_number = $request->input('asset_number');
        $mikan_amount = $request->input('invest_amount');
        
        DB::table('codes')
            ->insert(
                ['user_id' => $userno_id, 'asset_number' => $mikan_number, 'invest_amount' => $mikan_amount]
        );
        
        DB::table('assets')
            ->where('id', 1)
            ->increment('asset_sum', $mikan_amount);
        
        return redirect('/asset/mikan');
    }
    
    public function tasks(Request $request) {
        return User::all();
    }
    
}
