@extends('layouts.app')

@section('appp', 'サチコ領域　みかん')



@section('content')
<p>みかｎ</p>
<form action='/asset/mikan' method="post">
    @csrf
<input type="hidden" name="user_id" value="<?php echo $prove_user ?>">
<input type="hidden" name="asset_number" value="1">
    <p>{{ $prove_user }}</p>
<tr><td>投資額</td><br><th><input type="number" name="invest_amount"></th></tr><br>
<input type="submit" value="みかんに投資するなら押してね">
</form>
@endsection