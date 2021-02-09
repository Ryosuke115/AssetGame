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

@foreach ($dividend_asset as $value)
<p>{{ $value }}</p>
@endforeach
<div id="app">

</div>

@endsection