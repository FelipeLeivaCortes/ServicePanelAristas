<section>
    <!-- Nombre -->
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ $permission->name ?? old('name') }}" @if (!isset($permission) && is_null(old('name')))
            placeholder='Ingrese nombre del permiso' @endif required>
    </div>

    <!-- Familia -->
    <div class="form-group">
        <label for="family">Familia</label>
        <select name="family" id="family" class="form-control" required>
            @if ( isset($permission) || !is_null(old('family')) )
                @foreach ($families as $family)
                    <option value="{{ $family['name'] }}">{{ $family['name'] }}</option>
                @endforeach

                <script>
                    setTimeout(() => {
                        const value = {{ isset($permission) ? $permission->family : old('family') }};
                        $('#family').val(value);
                    }, 100);
                </script>
            @else
                <option value="" disabled selected>Seleccione familia</option>
                
                @foreach ($families as $family)
                    <option value="{{ $family['name'] }}">{{ $family['name'] }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <!-- Orden -->
    <div class="form-group">
        <label for="order">Orden</label>
        <input type="number" min="1" name="order" class="form-control"
            value="{{ $permission->order ?? old('order') }}" @if (!isset($permission) && is_null(old('order')))
            placeholder='Ingrese orden del permiso' @endif required>
    </div>
</section>