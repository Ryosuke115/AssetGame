@extends('layouts.app')

@section('appp', 'PownddAsset|資産板')

@section('content')

<form action="/transact_market" method="post">
@csrf
    <p>資産詳細選択</p>
    <select id="asset_select" name="asset_select">
    @foreach ($assets as $asset_select)
        <option value="<?php echo $asset_select ?>">
            {{ array_shift($assets) }}
        </option>
    @endforeach
    </select>
</form>

<div id="app">
<asset-board></asset-board>
</div>

@endsection