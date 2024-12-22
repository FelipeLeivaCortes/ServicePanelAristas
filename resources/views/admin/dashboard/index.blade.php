@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row px-2 mt-5">
        <!-- EMPRESAS REGISTRADAS -->
        @can('Ver Empresas')
            <div class="col small-box bg-secondary mr-2">
                <div class="inner">
                    <h3>{{ $companies->count() }}</h3>
                    <p>Empresas</p>
                </div>

                <div class="icon">
                    <i class="far fa-building"></i>
                </div>

                <a href="{{route('admin.companies.index')}}" class="small-box-footer">Ver Empresas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        @endcan
    </div>
@stop