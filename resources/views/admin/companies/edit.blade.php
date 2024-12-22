@extends('adminlte::page')

@section('title', 'Actualizar Datos')

@section('content_header')
    <h1>Empresa {{ $company->name }}</h1>
@stop

@section('content')
    @include('resources.alerts')

    <div class="card">
        {{ html()->form('PUT', route('admin.companies.update', ['company' => $company]))->attribute('enctype', 'multipart/form-data')->open() }}
            <div class="card-body">
                @include('admin.companies.partials.form')
            </div>

            <div class="card-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                <a href="{{route('admin.companies.index')}}" class="btn btn-danger">Volver</a>
            </div>
        {{ html()->form()->close() }}
    </div>
@stop