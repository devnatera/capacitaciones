@extends('layouts.content')

@section('content-page')
    <div class="row justify-content-center m-0">
        <div class="col-12">
            <div class="card m-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <span class="fs-3">Inscripciones a capacitaciones</span>
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
                                        <i class="bi bi-easel3-fill pe-2"></i>
                                        {{$capacitacion->nombre}}

                                        <br><i class="bi bi-hash pe-2"></i> Cupo: {{$capacitacion->cupo}}
                                        <br><i class="bi bi-hash pe-2"></i> Inscritos: {{$capacitacion->numero_inscripciones}}
                                        <br><i class="bi bi-calendar-check pe-2"></i> {{$capacitacion->fecha}}
                                        <br><i class="bi bi-hourglass-top pe-2"></i> {{$capacitacion->hora_inicio}}
                                        <br><i class="bi bi-hourglass-bottom pe-2"></i></i> {{$capacitacion->hora_fin}}
                                        <br><i class="bi bi-layers-fill pe-2"></i> {{$capacitacion->estado ? 'Activa' : 'Inactiva' }}

                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between align-items-baseline">
                                            <form action="{{ route('inscripciones.update',(int)$capacitacion->id) }}"
                                                  method="POST" style="min-width: 80px;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm"
                                                        @if($capacitacion->asistencia || ($capacitacion->cupo_disponible < 1))
                                                            disabled
                                                        @endif
                                                >
                                                    <i class="bi bi-check-square"></i> Confirmar asistencia
                                                </button>
                                            </form>
                                            <form action="{{ route('inscripciones.destroy',$capacitacion->id) }}"
                                                  method="POST" style="min-width: 80px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        @if(!$capacitacion->asistencia)
                                                            disabled
                                                        @endif
                                                >
                                                    <i class="bi bi-trash3"></i> Cancelar asistencia
                                                </button>
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
