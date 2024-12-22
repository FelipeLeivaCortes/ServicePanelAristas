@extends('adminlte::page')

@section('title', 'Lista de Permisos')

@section('content_header')
    <h1>Administración de Permisos</h1>
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
                    @can('Crear Permiso')
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary btn-sm" href="{{route('admin.permissions.create')}}">Agregar Permiso <span class="sr-only">(current)</span></a>
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
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Familia</th>
                        <th>Orden</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->family }}</td>
                                <td>{{ $permission->order }}</td>
                                <td class="td_btn">
                                    @can('Actualizar Permiso')
                                        <a class="btn btn-warning btn-sm" href="{{route('admin.permissions.edit', $permission)}}">
                                            <i class="fas fa-fw fa-edit"></i> Actualizar
                                        </a>
                                    @else
                                        <p>&nbsp;</p>
                                    @endcan
                                </td>
                                <td class="td_btn">
                                    @can('Eliminar Permiso')
                                    {{ html()->form('DELETE', route('admin.permissions.destroy', ['permission' => $permission]))->class('deletePermission')->open() }}
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-fw fa-trash"></i> Eliminar
                                        </button>
                                    {{ html()->form()->close() }}
                                    @else
                                        <p>&nbsp;</p>
                                    @endcan
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