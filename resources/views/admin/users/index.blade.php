@extends('adminlte::page')

@section('title', 'Lista de Usuarios')

@section('content_header')
    <h1>Administración de Usuarios</h1>
@stop

@section('content')
    @include('resources.alerts')
    
    <!-- Navbar -->
    <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @can('Crear Usuario')
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary btn-sm" href="{{route('admin.users.create')}}">Agregar Usuario <span class="sr-only">(current)</span></a>
                        </li>
                    @endcan
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
                            @can('Ver Empresas')
                                <th>Empresa</th>
                            @endcan
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Vigencia</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                @can('Ver Empresas')
                                    <td>{{ $user->company->name }}</td>
                                @endcan
                                <td>{{ $user->rut }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @if ( count($user->roles) > 0 )
                                        {{ $user->roles[0]->name }}
                                    @else
                                        <p class="text-muted">Sin Rol</p>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->is_active)
                                        <p class="text-success">Vigente</p>
                                    @else
                                        <p class="text-danger">Deshabilitada</p>
                                    @endif
                                </td>
                                <td class="td_btn">
                                    @can('Actualizar Usuario')
                                        <a class="btn btn-warning btn-sm" href="{{route('admin.users.edit', $user)}}">Actualizar</a>
                                    @else
                                        <p>&nbsp;</p>
                                    @endcan
                                </td>
                                <td class="td_btn">
                                    @if ($user->id != 1)
                                        @can('Eliminar Usuario')
                                            {{ html()->form('DELETE', route('admin.users.destroy', ['user' => $user]) )->class('deleteUser')->open() }}
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            {{ html()->form()->close() }}
                                        @else
                                            <p>&nbsp;</p>
                                        @endcan
                                    @else
                                        <p>&nbsp;</p>
                                    @endif
                                </td>
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