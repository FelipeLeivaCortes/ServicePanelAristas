<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Print Guide</title>

        <style>
            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }

            .mt-5{
                margin-top: 5rem;
            }

            .mt-4{
                margin-top: 4rem;
            }

            .mt-3{
                margin-top: 3rem;
            }

            .mt-2{
                margin-top: 2rem;
            }

            .mt-1{
                margin-top: 1rem;
            }

            .mt-0{
                margin-top: 0rem;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }
            .container{
                text-align:center
            }
            .left{
                float: left;
            }
            .right{
                float: right;
            }
            .center{
                margin:0 auto;
            }

            form{
                padding:16px;
                margin:auto;
            }

            form p{
                width:180px;
                padding:3px 10px;
                margin:8px 0;
                display:inline-block;
            }

            .label{
                width:72px;
                font-weight:bold;
                display:inline-block;
            }

            image{
                width: 1px;
                height: 1px;
            }

        </style>
    </head>
    <body>
        <!-- Header -->
        <div class="container">
            <div class="left">
                <img src="{{ asset($url)}}" alt="Logo Empresa">
            </div>

            <div class="right">
                <h4></h4>
            </div>

            <div class="center">
                <h2>{{$category}}</h2> 
            </div>
        </div>        

        <!-- Content -->
        <div class="card">
            <div class="card-header">
                <p>Se han encontrado los siguientes errores en su archivos</p>
            </div>

            <div class="card-body">
                <ul>
                    @foreach ($errors as $error)
                        <li>
                            <p>{{$error}}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </body>
</html>