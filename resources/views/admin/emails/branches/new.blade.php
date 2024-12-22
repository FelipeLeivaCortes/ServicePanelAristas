@extends('admin.emails.template')

@section('title')
    Estimados
@endsection

@section('content')
    Les informamos que con fecha {{date('d-m-Y')}} se ha registrado una nueva sucursal en su empresa,
    por lo tanto, desde ahora será posible asociar usuarios, actividades y guías de mantención a esta sucursal.
@endsection
