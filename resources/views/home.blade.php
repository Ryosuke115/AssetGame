@extends('layouts.app')

@section('appp', 'PowndadAsset')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メニュー') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/asset/menu">現在の市況</a><br>
                    <a href="/schedule">Pown社決算スケジュール</a><br><!--フォントのデザインでサイト色を出す-->
                    <a href="/market">売買取引注文を行う</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
