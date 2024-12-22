@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1>Administración Perfil</h1>
@stop

@section('content')
    @include('resources.alerts')
    
    <!-- ACTUALIZAR CONTRASEÑA -->
    <section>
        <div class="card">
            <div class="card-header">
                <h4>Actualizar Contraseña</h4>
            </div>

            {{ html()->form('POST', route('admin.profile.updatePassword', ['user' => $user]))->open() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="current_pass">Contraseña Actual</label>
                        <input type="password" name="current_pass" id="current_pass" class="form-control"
                            placeholder="Ingrese su contraseña actual" required>
                    </div>
                    <div class="form-group">
                        <label for="new_pass">Contraseña Nueva</label>
                        <input type="password" name="new_pass" id="new_pass" class="form-control"
                            placeholder="Ingrese su contraseña actual" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_pass">Confirme Contraseña</label>
                        <input type="password" name="confirm_pass" id="confirm_pass" class="form-control"
                            placeholder="Reingrese su contraseña nueva" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="submit" value="Actualizar" class="btn btn-primary" disabled id="btn_send">
                    </div>
                </div>
            {{ html()->form()->close() }}
        </div>
    </section>
@stop

@section('adminlte_js')
    <script src="{{asset('js/updatePassword.js')}}"></script>
@endsection