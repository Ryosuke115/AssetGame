<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserRegistered;
use Illuminate\Support\Str;

class SampleController extends Controller
{
    public function events()
    {
        event(new UserRegistered(Str::random(100)));
        
        return view('sample_events');
    }
}
