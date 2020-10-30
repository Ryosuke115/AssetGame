<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $primarykey = array('id');
    
    
    
    public static $rules = array(
     'user_id' => 'required',
     'asset_number' => 'required',
     'invest_amount' => 'required|integer',
    );
    
    public function getData() {
        return $this->id . ':' . $this->asset_number;//asset_numberは当該国の資産を区別するための番号　サチコの牛肉は3番
    }
    
    public function sdData() {
        return $this->hasOne('App/Asset');
    }
    
    /*public function getBeaf() {
        $plus = 0;
        $zero = 0;
        $bee = $this->invest_amount + 
    }*/
    
    protected $casts = [
       'invest_amount' => 'int',
    ];
}
    