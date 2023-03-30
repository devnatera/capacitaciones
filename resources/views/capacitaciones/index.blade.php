@extends('layouts.content')

@section('content-page')
    <div class="row justify-content-center m-0">
        <div class="col-12">
            <div class="card m-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <span class="fs-3">Capacitaciones</span>
                        <a href="{{ route('capacitaciones.create') }}" class="btn btn-outline-success fs-5">
                            <i class="bi bi-plus-circle-dotted"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session()->get('notifications'))
                        <div class="alert alert-success col-md-10 my-2 m-auto" role="alert">
                            {{ session()->get('notifications') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger col-md-10 my-2 m-auto" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        @foreach($capacitaciones as $capacitacion)
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-2">
                                <div class="card">
                                    <div class="card-header bg-dark bg-gradient text-white">
                                        <span class="fs-5">Capacitación</span>
                                    </div>
                                    <div class="card-body">
                                        <i class="bi bi-person-vcard-fill pe-2"></i>
                                        {{$capacitacion->nombre}}

                                        <br><i class="bi bi-geo-alt-fill pe-2"></i> {{$capacitacion->cupo}}
                                        <br><i class="bi bi-geo-alt-fill pe-2"></i> {{$capacitacion->fecha}}
                                        <br><i class="bi bi-geo-alt-fill pe-2"></i> {{$capacitacion->hora_inicio}}
                                        <br><i class="bi bi-geo-alt-fill pe-2"></i> {{$capacitacion->hora_fin}}
                                        <br><i class="bi bi-geo-alt-fill pe-2"></i> {{$capacitacion->estado ? 'Activa' : 'Inactiva' }}

                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between align-items-baseline">
                                            <form action="{{ route('capacitaciones.destroy',$capacitacion->id) }}"
                                                  method="POST" style="min-width: 80px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                                {{-- Edit --}}
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{ route('capacitaciones.edit', $capacitacion->id) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
