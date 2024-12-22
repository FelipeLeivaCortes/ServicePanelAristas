<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correo Masivo - No Responder</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-start">
                    <div class="col-2">
                        @php
                            $defaultURL = 'storage/shared/images/default_company.png';

                            if (isset($branch)) {
                                $logo   = is_null($branch->company->image) ? $defaultURL : $branch->company->image->url;
                            } elseif (isset($user)) {
                                $logo   = is_null($user->branches[0]->company->image) ? $defaultURL : $user->branches[0]->company->image->url;
                            }
                        @endphp

                        <img src="{{ asset($logo) }}" alt="Logo Empresarial" class="mt-1" width="100px">
                    </div>
                    <div class="col align-content-center">
                        <h2 class="h3">@yield('title')</h2>
                    </div>
                </div>
                
                <div class="mt-4">
                    <p>@yield('content')</p>
                </div>

                <div>
                    <p>
                        <i>Recuerda que ante cualquier duda nos puedes contactar al correo <b>soporte@mantencionembalses.com</b>, o en caso
                        que encuentres algún problema con la plataforma, nos puedes informar a través de la sección tickets
                        </i>
                    </p>
                    <p class="mt-4"><i><b>Saludos Cordiales</b></i></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>