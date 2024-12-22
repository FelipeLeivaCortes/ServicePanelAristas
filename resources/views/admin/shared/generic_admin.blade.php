<div>
    <!-- EMPRESA -->
    @can('Ver Empresas')
        <div class="form-group">
            <label for="company_id">Empresa</label>
            <select name="company_id" id="company_id" class="form-control" required>
                <option value="" disabled selected>Seleccione una empresa</option>
                
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

    @else
        <input type="hidden" name="company_id" id="company_id" value="{{ $company_id }}" required>
    @endcan

    {{-- @section('adminlte_js')
        <script src="{{ asset('js/initBranches.js') }}" defer></script>

        <script type="text/javascript" defer>
            document.addEventListener('DOMContentLoaded', () => {
                const companyId         = @json(old('company_id') ?? ($company_id ?? null));

                initBranches(companyId);
            });
        </script>
    @endsection --}}
</div>
