<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SachikoController extends Controller
{
    
    public function mikan_view(Request $request){
        $id = Auth::id();
        return view('asset.sachiko.mikan', ['prove_user' => $id]);
    }
    
    public function mikan_stock(Request $request) {
        $this->validate($request, Code::$rules);
        $user_id = $request->input('user_id');
        $mikan_number = $request->input('asset_number');
        $mikan_amount = $request->input('invest_amount');
        
        DB::table('codes')
            ->insert(
                ['user_id' => $user_id, 'asset_number' => $mikan_number, 'invest_amount' => $mikan_amount]
        );
        
        DB::table('assets')
            ->where('id', 1)
            ->increment(['asset_sum', $mikan_amount]);
        
        return redirect('home');
    }
}
