@extends('layouts.app')

@section('appp', 'PowndadAsset-注文')

@section('content')

<form action="/market" method="post">
 @csrf
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
    
    <p>銘柄選択</p>
    <select name="market_asset">
    @foreach ($accounts as $account_number)
        <option value="<?php echo  $account_number?>">
            {{ array_shift($asset_name) }}
        </option>
    @endforeach
    </select>
    
    <select name="buy_sell">
     <option value="0">買い</option>
     <option value="1">売り</option>
    </select>
    
    <p><input type="number" name="transaction" required>数量選択</p><!--maxのvalidateはlaravel側のModelで行う-->
    
    <input type="submit" value="決定">
</form>

@endsection
