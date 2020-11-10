<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
