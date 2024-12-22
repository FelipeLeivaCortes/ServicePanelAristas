$(document).ready(function() {
    function handleDelete(event, title) {
        event.preventDefault();
        const form = event.target;

        Swal.fire({
            title: title,
            text: "¡Esta acción es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    const deleteActions = {
        '.deleteCompany':       '¿Estás seguro que deseas eliminar esta empresa?',
        '.deleteBranch':        '¿Estás seguro que deseas eliminar esta sucursal?',
        '.deletePermission':    '¿Estás seguro que deseas eliminar este permiso?',
        '.deleteRole':          '¿Estás seguro que deseas eliminar este rol?',
        '.deleteUser':          '¿Estás seguro que deseas eliminar este usuario?',
        '.deleteLocation':      '¿Estás seguro que deseas eliminar este sector?',
        '.deleteActivity':      '¿Estás seguro que deseas eliminar esta actividad?',
        '.deleteRecord':        '¿Estás seguro que deseas anular esta guía de mantención?',
        '.deleteDocument':      '¿Estás seguro que deseas eliminar este documento?',
        '.deleteTicket':        '¿Estás seguro que deseas cerrar este ticket?'
    };

    $.each(deleteActions, function(selector, title) {
        $(document).on('submit', selector, function(e) {
            handleDelete(e, title);
        });
    });
});
