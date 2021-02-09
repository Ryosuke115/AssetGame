@extends('layouts.app')

@section('title', 'Pawn dadAsset|注文')

@section('content')
<div id="app">
 <transact-board></transact-board>
   
</div>

<form action="/market" method="post">
 @csrf
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
    
    
      <p style="color: red; font-size: 20px;"><?php echo $error ?></p>
    
    <p>銘柄選択</p>
    <select name="market_asset">
    <option value="1">みかん</option>
    <option value="2">じゃがいも</option>
    <option value="3">牛肉</option>
    <option value="4">製鉄</option>
    <option value="5">国防力</option>
    <option value="6">オン・アニー</option>
    </select>
    
    <market-order-form></market-order-form>
    <!--<select name="buy_sell">
     <option value="0">買い</option>
     <option value="1">売り</option>
     <option value="2">成行買い</option>
     <option value="3">成行売り</option>
    </select>
    
    <p><input type="number" name="transaction" required>数量選択</p>maxのvalidateはlaravel側のModelで行う-->
    
    <input type="submit" value="決定">
</form>

@endsection