@extends('adminlte::page')

@section('title', 'Registrar Usuario')

@section('content_header')
    <h1>Registrar Usuario</h1>
@stop

@section('content')
    @include('resources.alerts')

    <div class="card">
        {{ html()->form('POST', route('admin.users.store'))->open() }}
            <div class="card-body">
                @include('admin.users.partials.form')
            </div>

            <div class="card-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                <a href="{{route('admin.users.index')}}" class="btn btn-danger">Volver</a>
            </div>
        {{ html()->form()->close() }}
    </div>
@stop