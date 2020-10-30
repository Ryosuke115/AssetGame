@extends('layouts.app')

@section('appp', 'Code.index')

@section('menubar')
   @parent
   ボード
@endsection

@section('content')
   <table>
      <form action="/code/add" method="post">
          @csrf
          <tr><th>ユーザーID: </th><td><input type="number" name="user_id"></td></tr>
          <tr><th>投資先番号：</th><td><input type="number" name="asset_number"></td></tr>
          <tr><th>資金投入額：</th><td><input type="number" name="invest_amount"></td></tr>
          <tr><th></th><td><input type="submit" value="送信ペイします"></td></tr>
       </form>
   </table>
@endsection

@section('footer')
copyright 2020 andou
@endsection