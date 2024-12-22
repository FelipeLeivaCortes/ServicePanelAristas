@extends('adminlte::page')

@section('title', 'Actualizar Datos')

@section('content_header')
    <h1>Actualizar Rol</h1>
@stop

@section('content')
    @include('resources.alerts')

    <div class="card">
        {{ html()->form('PUT', route('admin.roles.update', ['role' => $role]))->open() }}
            <div class="card-body">
                @include('admin.roles.partials.form')
            </div>

            <div class="card-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                <a href="{{route('admin.roles.index')}}" class="btn btn-danger">Volver</a>
            </div>
        {{ html()->form()->close() }}
    </div>
@stop

@section('adminlte_js')
    @if (!empty($ownPermissions) || !is_null(old('permissions')))
        <script>
            const permissions = @json(!empty($ownPermissions) ? $ownPermissions : old('permissions'));

            permissions.forEach(permission => {
                const id = 'permission_' + permission.id ?? permission;
                $("#" + id).prop('checked', true);
            });
        </script>
    @endif
@endsection