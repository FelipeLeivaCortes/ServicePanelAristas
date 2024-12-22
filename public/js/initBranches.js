
/**
 * Se encarga de filtrar las sucursales que le pertenecen a la empresa seleccionada.
 * 
 * @param {json} branches - JSON con el listado de todas las sucursales.
 * @param {array} branchAvailables - Array con las sucursales que tiene registrada el objeto.
 * @param {number} companyId - ID de la empresa.
 * @param {number} uniqueBranch - Se puede seleccionar mas de una sucursal?.
 * @returns {void}
 */
const initBranches  = (branches, branchAvailables, companyId, uniqueBranch) => {
    const allBranches = Object.values(branches);

    $('#company_id').on('change', function() {
        renderBranches($(this).val(), allBranches, uniqueBranch);
    });

    if (companyId) {
        $('#company_id').val(companyId);

        renderBranches(companyId, allBranches, uniqueBranch)
            .then(() => {
                $('#company_id').trigger('change');
                assignBranches(branchAvailables, uniqueBranch);
            });
    }
};

/**
 * Activa como checkeada cada una de las sucursales que tenga inscrita el objeto.
 * 
 * @param {array} branches - Array con el listado de sucursales que tiene asociadas el objeto.
 * @param {number} uniqueBranch - Se puede seleccionar mas de una sucursal?.
 */
const assignBranches = (branches, uniqueBranch) => {
    
    if (Array.isArray(branches)) {
        for (const branch of branches) {
            $(`#${branch.id}`).prop('checked', true);
        }
    } else {
        $(`#${branches.id}`).prop('checked', true);
    }

    if (uniqueBranch && (!Array.isArray(branches) || branches.length > 0)) {
        $('#branchesContainer input[type="checkbox"]').each(function() {
            if (!$(this).prop('checked')) {
                $(this).prop('disabled', true);
            }
        });
    }
};

/**
 * Crea los checkbox con las sucursales asociadas a la empresa que se ha seleccionado.
 * 
 * @param {number} companyId - ID de la empresa.
 * @param {array} allBranches - Array con la lista de todas las sucursales.
 * @param {number} uniqueBranch - Se puede seleccionar mas de una sucursal?.
 */
const renderBranches    = (companyId, allBranches, uniqueBranch) => { 
    return new Promise((resolve, reject) => {
        const idContanier   = '#branchesContainer';
        $(idContanier).empty();

        let elements    = allBranches.filter(branch => branch.company_id == companyId );

        for (const element of elements) {
            const divParent = $('<div/>').addClass('pl-3');
            const paragraph = $('<p/>');
            const checkbox  = $('<input/>', {
                type:   'checkbox',
                name:   'branches[]',
                id:     element.id,
                class:  'mr-1',
                value:  element.id
            });
            const label     = $('<span/>').text(element.name);

            if (uniqueBranch) {
                checkbox.on('change', function() {
                    const isChecked = $(this).is(':checked');
                    $('#branchesContainer').find('input[type="checkbox"]').not(this).prop('disabled', isChecked);
                });
            }
    
            paragraph.append(checkbox);
            paragraph.append(label);
            divParent.append(paragraph);
            
            $(idContanier).append(divParent);
        }

        if ($(idContanier).children().length == 0) {
            $(idContanier).append(
                $('<p/>').text('No hay sucursales activas').addClass('text-danger')
            );
        }

        return resolve(true);
    });
};