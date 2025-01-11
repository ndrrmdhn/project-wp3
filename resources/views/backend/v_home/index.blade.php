@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="col-xs-12">

    <div class="box-content">
        <h4 class="box-title"> {{$judul}} </h4>
        @if(Auth::check())
            Selamat datang <b>{{ Auth::user()->nama }}</b>
        @else
            Selamat datang
        @endif

    </div>
</div>

<!-- end template-->
@endsection