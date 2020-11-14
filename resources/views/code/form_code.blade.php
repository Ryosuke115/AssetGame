@extends('layouts.app')

@section('appp', '投資先選択画面')


@section('menubar')
  @parent
   ボード
@endsection

@section('content')
<form action="/code/form" method="post">
 @csrf
 <input type="hidden" name="user_id" value="<?php echo $prove_user ?>">

 <p>サチコ国：<br>
 <select name="asset_number">
     <option value="1">みかん</option>
     <option value="2">じゃがいも</option>
     <option value="3">牛肉</option>
     <option value="4" selected>製鉄</option>
     <option value="5">国防力</option>
     <option value="6">オン・アニー</option>
     </select></p>
    <tr><td>投資額</td><th><input type="number" name="invest_amount"></th></tr>
    <input type="submit" value="ペイします">
</form>

@endsection