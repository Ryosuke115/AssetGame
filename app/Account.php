<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    protected $primarykey = array('id');
    
    
    
    public static $rules = array(
      'user_id' => 'required|integer',
      'asset_number' => 'required|integer',
      'account_amount' => 'required|numeric',
      'stock_unit' => 'required|multipleof:10|min:10',
    );
    
     
    
}
