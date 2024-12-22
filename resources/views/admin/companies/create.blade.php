@extends('adminlte::page')

@section('title', 'Registrar Empresa')

@section('content_header')
    <h1>Registrar Empresa</h1>
@stop

@section('content')
    @include('resources.alerts')

    <div class="card">
        {{ html()->form('POST', route('admin.companies.store'))->attribute('enctype', 'multipart/form-data')->open() }}
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