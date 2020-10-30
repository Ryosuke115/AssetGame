<?php

namespace App\Http\Controllers;

use App\Code;
use App\User;
use App\Letter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CodeController extends Controller
{
    public function index(Request $request) {
        $items = Code::all();
        //$pinn = User::all();
        $pinn = date('D');
        $beaff = DB::table('codes')->pluck('invest_amount');
        //$bee = Code::where('invest_amount', '10000')
                  //->get();
        $values = $beaff->all();//配列に変換
        $last = array_key_last($values);
        $beaf = 0;
        
        
        
        for($i=0; $i<$last+1; $i++) {
            
            //aa = $i + 1;
            $rrr = $beaff[$i];// + $beaff[$aa];
            $beaf += $rrr;
        }
        
        
        //$beaf = $beaff[0] + $beaff[1];
        $bee = 0;
        $bea = $beaff[1];
        
        return view('code.index', ['items' => $items, 'pin' => $pinn, 'beaf' => $beaf, 'beaff' => $beaff, 'bee' => $bee, 'beal' => $bea, 'last' => $last]);
        
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
        
        DB::table('codes')
            ->insert(
              ['user_id' => $user_id, 'asset_number' => $asset_number, 'invest_amount' => $invest_amount]
        );
        
        DB::table('assets')
            ->where('id', $asset_number)
            ->increment('asset_sum', $invest_amount);
        
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
}