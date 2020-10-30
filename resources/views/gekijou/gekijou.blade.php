@extends('layouts.app')

@section('appp', '郵便')


@section('content')
<table><!-- tableタグ一族　th:表の見出し、タイトル tr:表の行を表示 td:表のデータを入れるために使う要素 -->
    <tr><!-- 行の横一列目の設定 -->
     <th>FROM</th>
     <th>件名</th>
    </tr>
    
    <tr>
    <td></td><!--post.phpに設定したgetDataを用いて届いた手紙一覧を表示する -->
    </tr>
    
</table>

@foreach ($stock as $stocks)
<p>{{ var_dump($stocks) }}</p>
@endforeach

<p>{{ $sachiko_mikan }}</p><!--userid2のユーザーがサチコのみかんに投資した額の合計の値-->
@endsection
  