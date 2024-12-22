
const setupLocations    = (locations) => {

    $('#company_id').on('change', function() {
        setTimeout(() => {
            const checkboxes    = $('#branchesContainer input[type="checkbox"]');

            checkboxes.each(function() {
                $(this).on('click', function() {
                    let listSelect;
                    
                    if ($(this).prop('checked')) {
                        listSelect  = locations.filter(location => location.branch_id == $(this).prop('id'));
                    } else {
                        listSelect  = [];
                    }

                    uploadLocations(listSelect);
                });
            });
        }, 500);
    });
}

const uploadLocations = (locations) => {
    $('#location_id').empty();

    $('#location_id').append(
        $('<option/>').prop({
            text: 'Seleccione un sector',
            value: null,
        })
    );

    locations.forEach(location => {
        const option = $('<option/>', {
            text: location.name,
            value: location.id,
        });

        $('#location_id').append(option);
    });
}
