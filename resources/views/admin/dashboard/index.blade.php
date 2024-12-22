@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row px-2 mt-5">
        <!-- TEXTO DE BIENVENIDA Y EXPLICACIÓN -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">¡Bienvenido al Panel de Servicio!</h4>
                    <p class="card-text">
                        Este panel te permite sincronizar datos entre <strong>WooCommerce - SAP</strong> de manera eficiente. 
                        Puedes realizar las siguientes acciones:
                    </p>
                    <ul>
                        <li>Sincronizar Productos.</li>
                        <li>Sincronizar Clientes.</li>
                        <li>Sincronizar Pedidos.</li>
                    </ul>
                    <p class="card-text">
                        Usa los botones disponibles para iniciar las sincronizaciones o gestionar los datos según sea necesario.
                        Si tienes dudas, puedes contactar al administrador.
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
