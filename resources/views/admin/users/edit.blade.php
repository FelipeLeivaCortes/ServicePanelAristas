@extends('adminlte::page')

@section('title', 'Actualizar Datos')

@section('content_header')
    <h1>Actualizar Datos</h1>
@stop

@section('content')
    @include('resources.alerts')

    <div class="card">
        {{ html()->form('PUT', route('admin.users.update', ['user' => $user]))->open() }}
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