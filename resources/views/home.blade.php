@extends('layouts.content')

@section('content-page')
    <div class="row justify-content-center m-0">
        <div class="col-md-10">
            <div class="card m-0">
                <div class="card-header">Bienvenido {{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
