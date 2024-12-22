@extends('adminlte::page')

@section('title', 'Lista de Empresas')

@section('content_header')
    <h1>Administración de Empresas</h1>
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
                    <li class="nav-item">
                        @can('Crear Empresa')
                            <a class="nav-link btn btn-primary btn-sm" href="{{route('admin.companies.create')}}">Agregar Empresa <span class="sr-only">(current)</span></a>
                        @endcan
                    </li>
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
                            <th>Dirección</th>
                            <th>Vigencia</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->rut }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->address }}</td>
                                <td>
                                    @if ($company->isValidLicense())
                                        <p class="text-success">Vigente</p>
                                    @else
                                        <p class="text-danger">Deshabilitada</p>
                                    @endif
                                </td>
                                <td class="td_btn">
                                    @can('Actualizar Empresa')
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin.companies.edit', $company) }}">
                                            <i class="fas fa-fw fa-edit"></i> Actualizar
                                        </a>
                                    @else
                                        <p>&nbsp;</p>
                                    @endcan
                                </td>
                                
                                @if ( $company->id != 1 )
                                    <td class="td_btn">
                                        @can('Eliminar Empresa')
                                            {{ html()->form('DELETE', route('admin.companies.destroy', ['company' => $company])
                                                    )->class('deleteCompany')->open()
                                            }}
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-fw fa-trash"></i> Eliminar
                                                </button>
                                            {{ html()->form()->close() }}
                                        @else
                                            <p>&nbsp;</p>
                                        @endcan
                                    </td>
                                @else
                                    <td class="td_btn">
                                        <p>&nbsp;</p>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@stop

@section('adminlte_js')
    <script src="{{ asset('js/initDatatables.js') }}" defer></script>
    <script src="{{ asset('js/initConfirmActions.js') }}" defer></script>
@endsection
