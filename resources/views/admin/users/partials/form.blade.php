<div>
    <!-- EMPRESA Y SUCURSALES -->
    @include('admin.shared.generic_admin')

    <!-- NOMBRE -->
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ $user->name ?? old('name') }}" @if (!isset($user) && is_null(old('name')))
            placeholder='Ingrese nombre completo del usuario' @endif required>
    </div>

    <!-- RUT -->
    <div class="form-group">
        <label for="rut">Rut</label>
        <input type="text" name="rut" id="rut" class="form-control"
            value="{{ $user->rut ?? old('rut') }}" @if (!isset($user) && is_null(old('rut')))
            placeholder='Ingrese rut del usuario' @endif required>
    </div>

    <!-- CORREO -->
    <div class="form-group">
        <label for="email">Correo</label>
        <input type="email" name="email" id="email" class="form-control"
            value="{{ $user->email ?? old('email') }}" @if (!isset($user) && is_null(old('email')))
            placeholder='Ingrese correo del usuario' @endif required>
    </div>

    <!-- ROL -->
    <div class="form-group">
        <label for="role_id">Rol</label>
        <select name="role_id" id="role_id" class="form-control" required>
            <option value="" disabled selected>Seleccione un rol</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- CELULAR -->
    <div class="form-group">
        <label for="phone">Celular (Opcional)</label>
        <div class="col-auto">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">+569</div>
                </div>

                <input type="text" name="phone" id="phone" class="form-control"
                    value="{{ $user->phone ?? old('phone') }}" @if (!isset($user) && is_null(old('phone')))
                    placeholder='Opcionalmente ingrese celular del usuario' @endif maxlength="8">
            </div>
        </div>
    </div>

    <!-- VIGENCIA -->
    @if ( \Illuminate\Support\Facades\Route::currentRouteName() == 'admin.users.edit' )
        <div class="form-group">
            <label for="is_active">Vigencia</label>
            <select name="is_active" id="is_active" class="form-control" required>
                @foreach ($states as $state)
                    <option value="{{ $state }}">{{ $state ? 'Activo' : 'Deshabilitado' }}</option>
                @endforeach
            </select>

            <script>
                setTimeout(() => {
                    const state = {{ old('phone') ?? $user->is_active }};
                    $('#is_active').val(state);
                }, 100);
            </script>
        </div>
    @endif

    <!-- SCRIPTS -->
    <script type="text/javascript" defer>
        document.addEventListener('DOMContentLoaded', () => {
            const role_id = @json(old('role_id') ?? ($user->roles[0]->id ?? null));

            if (role_id) {
                $('#role_id').val(role_id);
            }
        });
    </script>
</div>
