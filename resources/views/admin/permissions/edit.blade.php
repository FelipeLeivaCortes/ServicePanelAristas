@extends('adminlte::page')

@section('title', 'Actualizar Permiso')

@section('content_header')
    <h1>Actualizar Permiso</h1>
@stop

@section('content')
    @include('resources.alerts')

    <div class="card">
        {{ html()->form('PUT', route('admin.permissions.update', ['permission' => $permission]))->open() }}
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