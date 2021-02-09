<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Datetime;
use DateTimeZone;

class FiscalController extends Controller
{
    public function dividend_view(Request $request) {
        $jst_time = new Datetime();
        $jst_time->setTimeZone(new DateTimeZone('Asia/Tokyo'));
        $after = new Datetime('2020/01/09 12:12:12');
        
        $user_id = Auth::id();
        //決算日当日の資産の名前
        $dividend = Asset::where('fiscal_period', '<=', $jst_time)
                           ->pluck('asset_name');
        $dividend_asset = $dividend->all();
        
        return view('fiscal.dividend', ['jst_time' => $jst_time, 'after' => $after, 'dividend_asset' => $dividend_asset]);
    }
}
