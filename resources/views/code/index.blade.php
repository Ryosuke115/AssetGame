@extends('layouts.app')

@section('title', 'Code.index')

@section('menubar')
   @parent
   ボード
@endsection

@section('content')
 <p>{{ $beaf }}</p>
 <p>{{ var_dump($beaf) }}</p>
<p>{{ $last }}</p>
 <!--<p>{{ var_dump($beal) }}</p>-->


 
@foreach ($beaff as $key=>$beafs)
<!--<//?php 
   $plus = 1;
   $zero = 0;
   $bee += $beafs[$plus];
   $plus++;
 ?>-->
<p>{{ var_dump($beafs) }}</p>
@endforeach

   <table border="2">
     <tr><th>データ/</th></tr>
       @foreach ($items as $key=>$item)<!-- コントローラから渡された$itemsを$key=>$itemの連想配列の形で格納 -->
           <tr>
            <td>{{$item->getData()}}</td><!--codecontrollerのuse codeに繋がっているのでcode.phpのgetdataがつかえる？-->
           </tr>
       @endforeach
   </table>

<?php echo date('Y:D-H-i'); ?>
<p>{{ var_dump($pin) }}</p>
<p>{{ var_dump($buy) }}</p>

<div id="app">
    <my-component></my-component>
    <works-component></works-component>
    
</div>


@endsection

