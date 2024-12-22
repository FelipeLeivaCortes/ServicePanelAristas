@extends('admin.emails.template')
{{-- 
    The sections are:
        * title
    * content
--}}

@section('title')
    Estimado/a {{ $user->name }}
@endsection

@section('content')
    Te comentamos que con fecha {{date('d-m-Y')}} tu cuenta de usuario ha sido eliminada
@endsection