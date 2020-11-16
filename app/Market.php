<?php

namespace App;

use App\Code;
use App\User;
use App\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Market extends Model
{
    protected $primarykey = array('id');
    
    
    public static $rules = array(
    'user_id' => 'required',
    'asset_number' => 'required',
    'trade_type' => 'required',
    'transact__amount' => 'required',
    'created_at' => 'required',
     
    );
    
   
}
