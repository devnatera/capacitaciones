@extends('layouts.app')

@section('nav_title', 'Capacitaciones')

@section('content')
    <div class="d-flex">
        <div class="col-md-3 col-3">
            @include('shared.sidebar')
        </div>
        <div class="col-md-9 col-9">
            @yield('content-page')
        </div>
    </div>
@endsection
