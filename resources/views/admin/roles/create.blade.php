@extends('adminlte::page')

@section('title', 'Registrar Rol')

@section('content_header')
    <h1>Registrar Rol</h1>
@stop

@section('content')
    @include('resources.alerts')

    <div class="card">
        {{ html()->form('POST', route('admin.roles.store'))->open() }}
            <div class="card-body">
                @include('admin.roles.partials.form')
            </div>

            <div class="card-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                <a href="{{route('admin.roles.index')}}" class="btn btn-danger">Volver</a>
            </div>
        {{ html()->form()->close() }}
    </div>
@stop