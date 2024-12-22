@extends('adminlte::page')

@section('title', 'Lista de Roles')

@section('content_header')
    <h1>Administración de Roles</h1>
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
                        <a class="nav-link btn btn-primary btn-sm" href="{{route('admin.roles.create')}}">Agregar Rol <span class="sr-only">(current)</span></a>
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
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td class="td_btn">
                                    @can('Actualizar Rol')
                                        <a class="btn btn-warning btn-sm" href="{{route('admin.roles.edit', $role)}}">
                                            <i class="fas fa-fw fa-edit"></i> Actualizar
                                        </a>
                                    @else
                                        <p>&nbsp;</p>
                                    @endcan
                                </td>
                                @if ( $role->name != \App\Models\CustomRole::SUPERADMIN )
                                    <td class="td_btn">
                                        @can('Eliminar Rol')
                                            {{ html()->form('DELETE', route('admin.roles.destroy', ['role' => $role]))->class('deleteRole')->open() }}
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
                        @empty
                            <tr>
                                <td colspan="4">No se han encontrado resultados</td>
                            </tr>
                        @endforelse
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