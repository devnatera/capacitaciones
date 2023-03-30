@extends('layouts.content')

@section('content-page')
    <div class="row justify-content-center m-0">
        <div class="col-md-10">
            <div class="card m-0">
                <div class="card-header">Editar Capacitación</div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger my-2 m-auto" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{route('capacitaciones.update', (int)$capacitacion->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-8 col-12 m-auto p-2">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                       value="{{old('nombre', $capacitacion->nombre)}}" maxlength="255" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12 p-2">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha"
                                       value="{{old('fecha', $capacitacion->fecha)}}" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12 p-2">
                                <label for="cupo" class="form-label">Cupo</label>
                                <input type="number" class="form-control" id="fecha" name="cupo"
                                       value="{{old('cupo', (int)$capacitacion->cupo)}}">
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12 p-2">
                                <label for="hora_inicio" class="form-label">Hora inicio</label>
                                <input type="time" class="form-control" id="hora_inicio" name="hora_inicio"
                                       value="{{old('hora_inicio', $capacitacion->hora_inicio)}}" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12 p-2">
                                <label for="hora_fin" class="form-label">Hora fin</label>
                                <input type="time" class="form-control" id="hora_fin" name="hora_fin"
                                       value="{{old('hora_fin', $capacitacion->hora_fin)}}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
