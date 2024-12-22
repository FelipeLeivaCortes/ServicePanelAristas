@extends('admin.emails.template')

@section('title')
    Estimados
@endsection

@section('content')
    Les informamos que con fecha {{date('d-m-Y')}} se han actualizado los datos de la sucursal {{ $branch->name }}.
    Estos son los nuevos datos:
    <br>
    <table>
        <thead>
            <th colspan="6">DATOS ACTUALIZADOS</th>
        </thead>
        <tbody>
            <tr>
                <td>Empresa:</td>
                <td class="p-2">{{ $branch->company->name }}</td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td class="p-2">{{ $branch->name }}</td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td class="p-2">{{ $branch->address }}</td>
            </tr>
            <tr>
                <td>Vigencia:</td>
                <td class="p-2">
                    @if ($branch->is_active)
                        <p class="text-success">Vigente</p>
                    @else
                        <p class="text-danger">Deshabilitada</p>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
@endsection
