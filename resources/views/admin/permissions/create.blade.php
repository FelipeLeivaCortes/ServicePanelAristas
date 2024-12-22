@extends('adminlte::page')

@section('title', 'Registrar Permiso')

@section('content_header')
    <h1>Registrar Permiso</h1>
@stop

@section('content')
    @include('resources.alerts')

    <div class="card">
        {{ html()->form('POST', route('admin.permissions.store'))->open() }}
            <div class="card-body">
                @include('admin.permissions.partials.form')
            </div>

            <div class="card-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                <a href="{{route('admin.permissions.index')}}" class="btn btn-danger">Volver</a>
            </div>
        {{ html()->form()->close() }}
    </div>
@stop