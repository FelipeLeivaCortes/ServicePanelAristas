/**
 * Configura el comportamiento del enlace de descarga.
 * 
 * Esta función escucha el evento de clic en el enlace de descarga y genera dinámicamente
 * la URL de descarga según la opción seleccionada en los checkboxes dentro del contenedor
 * especificado.
 * 
 * @param {string} type - El tipo de plantilla que se descargará.
 * @returns {void}
 */
const setupDownloadTemplate = (type) => {
    $('#download_link').on('click', () => {
        $('#download_link').attr('href', '#');
        
        let founded         = false;
        let branch_id       = null;
        const checkboxes    = $('#branchesContainer input[type="checkbox"]');

        checkboxes.each(function() {
            if ($(this).prop('checked')) {
                founded = true;
                branch_id = $(this).val();
                return false;
            }
        });

        if (founded) {
            let downloadLink = `/admin/downloadTemplate/${branch_id}/${type}`;
            $('#download_link').attr('href', downloadLink);

        } else {
            Swal.fire({
                icon:   'info',
                title:  'Ups!',
                text:   "Para descargar una plantilla, debe seleccionar una sucursal",
            })
        }
    });
}
