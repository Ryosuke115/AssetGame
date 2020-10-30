@extends('layouts.app')

@section('appp', '資産設定フォーム')

@section('menubar')
 @parent
 資産設定フォーム一覧
@endsection

@section('content')
   
       <form action="/asset/host" method="POST">
          @csrf
        <tr><th>所属国(Country)</th><td><input type="text" name="country"></td></tr>
        <tr><th>資産の名前(Asset_name)</th><td><input type="text" name="asset_name"></td></tr>
        <tr><th>現段階での保有コイン額(asset_sum)</th><td><input type="number" name="asset_sum"></td></tr>
           <input type="submit" value="送信">
       </form>

@endsection

@section('footer')
copyright 2020 andou
@endsection