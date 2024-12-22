
let activities = [];

$(document).ready(function(){
    $('.addActivity').on('click', function(){
        const checkboxId    = this.id.split('_')[1];

        if (this.checked) {
            activities.push(checkboxId);

            const origin    = $(`#origin_${checkboxId}`).clone();
            const target    = $('<tr/>').prop('id', `target_${checkboxId}`);

            target.append( $('<td/>').append( $('<input>',{
                class:      'form-control-plaintext',
                name:       'activities[]',
                value:      checkboxId,
                readonly:   true,
            })));

            target.append(origin.children().slice(1, 5));
            $('#bodyRecord').append(target);

        } else {
            activities  = activities.filter(id => id !== checkboxId);
            $(`#target_${checkboxId}`).remove();

        }

        $('#divModalRecord').toggleClass('disabled', activities.length == 0);
    });
});


/**
 * Confirm if the user want to remove the specific suggestion
 * 
 * @param {button} button 
 */
function remove_row(button)
{
    Swal.fire({
        title:              'Advertencia',
        text:               "¿Esta seguro que desea quitar esta actividad sugerida?",
        icon:               'info',
        showCancelButton:   true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor:  '#d33',
        cancelButtonText:   'Cancelar',
        confirmButtonText:  'Confirmar'

    }).then((result) => {
        if (result.isConfirmed) {
            button.closest('tr').remove();
            
            if ( $('#suggestions_table').children().length == 0 ) {
                let row = $('<tr/>').append(
                    $('<td/>', {
                        text:       'No existen actividades sugeridas',
                        colspan:    '6',
                    })
                );
        
                $('#suggestions_table').append(row);
            }

            Swal.fire('La actividad ha sido retirada exitosamente', '', 'success');
        }
    })
}
