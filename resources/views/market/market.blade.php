@extends('layouts.app')

@section('appp', '現在の市場状況')

@section('content')

<form action="/market" method="post">
 @csrf
    <p>銘柄選択</p>
    <select name="market_to">
    @foreach ($accounts as $account_number)
        <option value="<?php echo  $account_number?>">{{ array_shift($asset_name) }}</option>
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
