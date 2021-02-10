<!-- 決算日の資産を検索し、配当を行う -->
@extends('layouts.app')

@section('title', 'Pawn dadAsset | 決算')

@section('content')
<p>{{ var_dump(date_format($jst_time, "Y/m/d H:i")) }}</p>

@if ($after > $jst_time)
    I ahvefl
@else
   kkkkk
@endif
<p>本日決算の資産</p>
@foreach ($dividend_asset as $value)
<p>{{ $value }}</p>
@endforeach

@if ($dividend_codes)
<form method="POST" action="dividend">
    @csrf
<input type="submit" value="配当を受け取る">
</form>
@endif

<p>{{var_dump($dividend_codes)}}</p>
<div id="app">

</div>

@endsection