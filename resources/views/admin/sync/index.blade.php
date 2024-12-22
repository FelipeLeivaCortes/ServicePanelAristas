@extends('adminlte::page')

@section('title', 'Sincronizador de Datos')

@section('content_header')
    <h1>Sincronizador</h1>
@stop

@section('content')
    @include('resources.alerts')

    <section>
        <div class="card">
            <div class="card-header gray-200">
                <!-- Contenedor de los botones -->
                <div class="d-flex justify-content-center align-items-center flex-wrap" style="min-height:150px;">
                    <button id="sync-woocommerce-sap" class="btn btn-primary btn-lg mx-3 my-2" style="width: 250px;">
                        <i class="fas fa-sync"></i> WooCommerce a SAP
                    </button>
                    <button id="sync-sap-woocommerce" class="btn btn-success btn-lg mx-3 my-2" style="width: 250px;">
                        <i class="fas fa-sync"></i> SAP a WooCommerce
                    </button>
                </div>
            </div>

            <div class="card-body">

                <!-- Consola -->
                <div style="background-color: #1e1e1e; color: #d4d4d4; height: 350px; overflow-y: auto; font-family: monospace; font-size: 14px; padding: 10px; border-radius: 5px;" id="console">
                    <p>Consola iniciada...</p>
                </div>

                <!-- Botones de descarga -->
                <div class="d-flex justify-content-center align-items-center flex-wrap mt-3">
                    <button id="download-console" class="btn btn-secondary btn-lg mx-3 my-2" style="width: 250px;" disabled>
                        <i class="fas fa-file"></i> Descargar Consola
                    </button>
                    <button id="download-data" class="btn btn-info btn-lg mx-3 my-2" style="width: 250px;" disabled>
                        <i class="fas fa-download"></i> Descargar Datos
                    </button>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <style>
        /* Efecto hover para los botones */
        .btn:hover {
            opacity: 0.9;
            transform: scale(1.02);
            transition: all 0.2s ease-in-out;
        }

        /* Botón WooCommerce a SAP */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        /* Botón SAP a WooCommerce */
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Botones de descarga */
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        /* .indented {
            margin-left: 20px;
            display: block;
        } */

    </style>
@stop

@section('js')
    <script>
        let dataTransfered = {};

        // Evento para sincronizar de WooCommerce a SAP
        document.getElementById('sync-woocommerce-sap').addEventListener('click', async function () {
            clearConsole();

            document.getElementById('download-console').disabled    = true;
            document.getElementById('download-data').disabled       = true;

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esto sincronizará los datos de WooCommerce a SAP.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, sincronizar',
                cancelButtonText: 'Cancelar'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        logToConsole('Iniciando sincronización de WooCommerce a SAP...');
                        
                        dataTransfered = { customers: [], orders: [], products: [] };

                        dataTransfered.customers    = await syncEntity('customers', '/admin/woocommerce/sync/customers');
                        dataTransfered.orders       = await syncEntity('orders', '/admin/woocommerce/sync/orders');
                        dataTransfered.products     = await syncEntity('products', '/admin/woocommerce/sync/products');

                        logToConsole('Sincronización completada para todas las entidades.');

                        Swal.fire(
                            '¡Sincronización completada!',
                            'Los datos se han sincronizado correctamente.',
                            'success'
                        );

                        document.getElementById('download-console').disabled    = false;
                        document.getElementById('download-data').disabled       = false;

                    } catch (error) {
                        logToConsole('Error durante la sincronización: ' + error.message);
                        Swal.fire(
                            'Error',
                            'Ocurrió un error durante la sincronización.',
                            'error'
                        );
                    }
                }
            });
        });

        // Evento para sincronizar de SAP a WooCommerce
        document.getElementById('sync-sap-woocommerce').addEventListener('click', async function () {
            clearConsole();
            document.getElementById('download-console').disabled    = true;
            document.getElementById('download-data').disabled       = true;

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esto sincronizará los datos de SAP a WooCommerce.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, sincronizar',
                cancelButtonText: 'Cancelar'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        logToConsole('Iniciando sincronización de SAP a WooCommerce...');
                        
                        dataTransfered = { customers: [], orders: [], products: [] };

                        dataTransfered.customers = await syncEntity('customers', '/admin/sap/sync/customers');
                        dataTransfered.orders = await syncEntity('orders', '/admin/sap/sync/orders');
                        dataTransfered.products = await syncEntity('products', '/admin/sap/sync/products');

                        logToConsole('Sincronización completada para todas las entidades.');
                        Swal.fire(
                            '¡Sincronización completada!',
                            'Los datos se han sincronizado correctamente.',
                            'success'
                        );

                        document.getElementById('download-console').disabled    = false;
                        document.getElementById('download-data').disabled       = false;
                    } catch (error) {
                        logToConsole('Error durante la sincronización: ' + error.message);
                        Swal.fire(
                            'Error',
                            'Ocurrió un error durante la sincronización.',
                            'error'
                        );
                    }
                }
            });
        });

        function syncEntity(entity, path) {
            return new Promise((resolve, reject) => {
                logToConsole(`Obteniendo datos de ${entity}...`);

                fetch(path, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Token CSRF
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        logToConsole(data.message);
                        resolve(data.data);
                    } else {
                        reject(new Error(data.message || 'Error desconocido'));
                    }
                })
                .catch(error => {
                    reject(error);
                });
            });
        }

        function clearConsole() {
            const consoleElement        = document.getElementById('console');
            consoleElement.innerHTML    = '<p>Consola iniciada...</p>';
        }

        function logToConsole(message) {
            const consoleElement    = document.getElementById('console');
            const timestamp         = new Date().toLocaleTimeString();
            const formattedMessage  = message.replace(/\n/g, '<br><span class="indented">');

            consoleElement.innerHTML    += `<p>[${timestamp}] ${formattedMessage}</p>`;
            consoleElement.scrollTop    = consoleElement.scrollHeight;
        }

        document.getElementById('download-console').addEventListener('click', function () {
            const consoleElement    = document.getElementById('console');
            const consoleText       = consoleElement.innerText;

            const blob  = new Blob([consoleText], { type: 'text/plain' });
            const url   = URL.createObjectURL(blob);

            const a     = document.createElement('a');
            a.href      = url;
            a.download  = 'consola.txt';
            a.click();

            URL.revokeObjectURL(url);
        });

        document.getElementById('download-data').addEventListener('click', function () {
            const jsonData = JSON.stringify(dataTransfered, null, 2);

            const blob  = new Blob([jsonData], { type: 'application/json' });
            const url   = URL.createObjectURL(blob);

            const a     = document.createElement('a');
            a.href      = url;
            a.download  = 'data_transfered.json';
            a.click();

            URL.revokeObjectURL(url);
        });
    </script>
@stop
