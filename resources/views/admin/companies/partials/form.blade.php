<div>
    <!-- NOMBRE -->
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control"
            value="{{ $company->name ?? old('name') }}" @if (!isset($company) && is_null(old('name')))
            placeholder='Ingrese nombre de la empresa' @endif required>
    </div>

    <!-- RUT -->
    <div class="form-group">
        <label for="rut">Rut</label>
        <input type="text" name="rut" id="rut" class="form-control"
            value="{{ $company->rut ?? old('rut') }}" @if (!isset($company) && is_null(old('rut')))
            placeholder='Ingrese rut de la empresa' @endif required>
    </div>

    <!-- CORREO -->
    <div class="form-group">
        <label for="email">Correo</label>
        <input type="email" name="email" class="form-control"
            value="{{ $company->email ?? old('email') }}" @if (!isset($company) && is_null(old('email')))
            placeholder='Ingrese correo de la empresa' @endif required>
    </div>

    <!-- DIRECCIÓN -->
    <div class="form-group">
        <label for="address">Dirección</label>
        <input type="text" name="address" class="form-control"
            value="{{ $company->address ?? old('address') }}" @if (!isset($company) && is_null(old('address')))
            placeholder='Ingrese dirección de la empresa' @endif required>
    </div>

    <!-- INICIO LICENCIA -->
    <div class="form-group">
        <label for="license_start">Inicio Licencia</label>
        <input type="date" name="license_start" class="form-control"
            value="{{ $company->license_start ?? old('license_start') }}" required>
    </div>

    <!-- TERMINO LICENCIA -->
    <div class="form-group">
        <label for="license_end">Termino Licencia</label>
        <input type="date" name="license_end" class="form-control"
            value="{{ $company->license_end ?? old('license_end') }}" required>
    </div>

    <!-- LOGO EMPRESARIAL -->
    <div class="form-group">
        <div class="card">
            <div class="card-header">
                <label for="">Logo Empresarial</label>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <label for="current-logo">Logo Actual</label>
                        <div class="current-logo">
                            @if(isset($company->image->url))
                                <img src="{{ asset($company->image->url) }}" alt="Logo Empresa" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                            @else
                                <img src="{{ asset('storage/shared/images/default_company.png') }}" alt="Logo Default" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="logo">Subir Nuevo Logo (OPCIONAL)</label>
                            <input type="file" name="logo" class="form-control-file" accept="image/*"
                                value="{{ $company->logo ?? old('logo') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .current-logo img {
            margin-top: 10px;
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #f8f9fa;
        }
    </style>


    <small>* NOTA 1: Para una correcta visualización, utilize una imagen pgn de 150px x 65px</small><br>
    <small>* NOTA 2: Vaya a este link para convertir su imagen si es muy grande <a href="https://www.iloveimg.com/es" target="_blank">Conversor Online</a> </small>
</div>
