<section>
    <!-- NOMBRE -->
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ $role->name ?? old('name') }}" @if (!isset($role) && is_null(old('name')))
            placeholder='Ingrese nombre del rol' @endif required>
    </div>

    <!-- LISTA DE PERMISOS -->
    <div class="form-group">
        <div class="card">
            <div class="card-header  bg-light">
                <strong>Permisos</strong>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach ($permissions as $permission)
                        <div class="card mb-5">
                            <div class="card-header bg-light">{{ $permission['family'] }}</div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-row">
                                        @foreach ($permission['permissions'] as $data)
                                            <div class="col-auto">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="permissions[]" id="permission_{{ $data->id }}" value="{{ $data->id }}">
                                                    <label class="form-check-label" for="permission_{{ $data->id }}">
                                                        {{ $data->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>