@extends('layouts.app')

@section('title', 'PowndadAsset|資産板')
<style>
    .pp {
        position: relative;
        bottom: 425px;
        color: green;
        /*writing-mode: vertical-rl;*/
        font-size: 17px;
        font-weight: 600;
    }
    
    #asset_selectis {
        
        position: relative;
        bottom: 270px;
    }
    
    .up {
        position: relative;
        bottom: 270px;
        font-weight: 14px;
    }
</style>
@section('content')

<div id="app">
<asset-board></asset-board>
</div>

<form action="/asset/invest" method="post">
@csrf
    <p class="pp">資産詳細選択</p>
    
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
    
    <p class="up">コイン投資先選択</p>
    <select id="asset_selectis" name="asset_number">
     <option value="1">みかん</option>
     <option value="2">じゃがいも</option>
     <option value="3">牛肉</option>
     <option value="4" selected>製鉄</option>
     <option value="5">国防力</option>
     <option value="6">オン・アニー</option>
    </select><br>
    
    <tr><td></td><th><input type="number" name="invest_amount" class="up"></th></tr>
    <input type="submit" value="投資する" class="up">
</form>



@endsection