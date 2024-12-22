/**
 * Filtra las temporadas y actualiza las opciones del select #season según la sucursal seleccionada.
 * 
 * @param {Array} seasons - Lista de temporadas registradas.
 * @returns {void}
 */
const filterSeasons = (seasons, waitBranches) => {
    const updateOptions = () => {
        if (seasons.length === 1) {
            updateSeasonOptions(Object.keys(seasons[0].data));
        } else if (seasons.length > 1) {
            setTimeout(() => setupCheckboxEventHandlers(seasons), 100);
        }
    };

    if (waitBranches === 1) {
        const targetNode = $('#branchesContainer')[0];
        const observer = new MutationObserver((mutationsList) => {
            if (mutationsList.some(mutation => mutation.type === 'childList' && mutation.addedNodes.length > 0)) {
                updateOptions();
            }
        });

        observer.observe(targetNode, { childList: true });
    } else {
        updateOptions();
    }
};

/**
 * Actualiza las opciones del select #season con los años proporcionados.
 * 
 * @param {Array} years - Lista de años disponibles.
 * @returns {void}
 */
const updateSeasonOptions = (years) => {
    const seasonSelect = $('#season');
    
    // Limpiar opciones existentes y agregar opción por defecto
    seasonSelect.empty().append(
        $('<option>', {
            text: 'Seleccione una temporada',
            value: '',
            disabled: 'disabled',
            selected: 'selected'
        })
    );

    // Agregar opciones de años
    years.forEach(year => {
        seasonSelect.append(
            $('<option>', {
                text: year,
                value: year
            })
        );
    });
};

/**
 * Configura los manejadores de eventos para los checkboxes dentro del contenedor #branchesContainer.
 * Cuando un checkbox se marca, filtra las temporadas según el branch_id asociado al checkbox
 * y actualiza las opciones del elemento select #season con los años disponibles de la temporada seleccionada.
 * 
 * @param {Array} seasons - Lista de temporadas registradas.
 * @returns {void}
 */
const setupCheckboxEventHandlers = (seasons) => {
    $('#branchesContainer input[type="checkbox"]').on('click', function() {
        let years = [];

        if ($(this).prop('checked')) {
            const selectedSeason = seasons.find(season => season.branch_id == this.id);
            if (selectedSeason) {
                years = Object.keys(selectedSeason.data);
            }
        }
        updateSeasonOptions(years);
    });
};
