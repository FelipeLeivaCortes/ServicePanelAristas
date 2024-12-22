@extends('adminlte::page')

@section('title', 'Lista de Notificaciones')

@section('content_header')
    <h1>Mis Notificaciones</h1>
@stop

@section('content')
    @include('resources.alerts')

    <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.companies.create')}}">Agregar Empresa <span class="sr-only">(current)</span></a>
                    </li> --}}
                </ul>
            </div>
        </nav>
    </section>

    <section>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped responsiveTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Ubicación</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{$company->id}}</td>
                                <td>{{$company->rut}}</td>
                                <td>{{$company->name}}</td>
                                <td>{{$company->direction}}</td>
                                <td width="10px">
                                    <a class="btn btn-info btn-sm" href="{{route('admin.companies.edit', $company)}}">Editar</a>
                                </td>
                                @if ( $company->id != 1 )
                                    <td width="10px">
                                        {!! Form::open(['route' => ['admin.companies.destroy', $company], 'class' => 'deleteCompany']) !!}
                                            @method('delete')
                                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                @else
                                    <td>---</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script src="{{asset('js/auto_datatable.js')}}"></script>
@endsection
