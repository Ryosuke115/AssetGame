<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $primarykey = array('id');
    
    public static $rules = array(
        'country' => 'required',
        'asset_name' => 'required',
        'asset_sum' => 'required',
    );
    
    }
