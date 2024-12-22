<div>
    @if ( session('success') )
        <script>
            setTimeout(() => {
                Swal.fire({
                    icon:   'success',
                    title:  'Operación Exitosa',
                    text:   "<?=session('success')?>",
                })
            }, {{ env('DELAY_POPUPS', 1000) }}
            );
        </script>
    @endif

    @if (session('warning'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    icon:   'warning',
                    title:  'Advertencia',
                    text:   "<?=session('warning')?>",
                })
            }, {{ env('DELAY_POPUPS', 1000) }});
        </script>
    @endif

    @if (session('info'))
        <script>
            console.log('a');

            setTimeout(() => {
                Swal.fire({
                    icon:   'info',
                    title:  'Notificación',
                    text:   "<?=session('info')?>",
                })
            }, {{ env('DELAY_POPUPS', 1000) }});
        </script>
    @endif

    @if (session('error'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    icon:   'error',
                    title:  'Error',
                    text:   "<?=session('error')?>",
                })
            }, {{ env('DELAY_POPUPS', 1000) }});
        </script>
    @endif

    @if ($errors->any())
        @php
            $error_list = "";

            foreach( $errors->all() as $error ){
                $error_list  = $error_list . $error .'<br>';
            }

        @endphp

        <script>
            setTimeout(() => {
                Swal.fire({
                    icon:   'error',
                    title:  'Errores',
                    html:   "<?=$error_list?>",
                })
            }, {{ env('DELAY_POPUPS', 1000) }});
        </script>
    @endif
</div>