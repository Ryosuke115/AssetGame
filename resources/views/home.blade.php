@extends('layouts.app')

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
                    <a href="/schedule">Pown社決算スケジュール</a><!--フォントのデザインでサイト色を出す-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
