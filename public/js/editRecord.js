$(document).ready(function() {
    $(document.body).addClass('sidebar-collapse');

    if ( $('#activities').children().length > 1 ) {
        $('#btn_add_row').on('click', function(){
            add_row();
        });

    } else {
        $('#btn_add_row').attr('disabled', true);
        $('#activities').attr('disabled', true);

    }

    $('#activities').on('change', function(){
        if ( $(this).val() == '' ) {
            $('#btn_add_row').attr('disabled', true);
        } else {
            $('#btn_add_row').attr('disabled', false);
        }
    });
});


/**
 * Add the suggest activity to the list
 */
function add_row()
{
    if ( $('#activities').val() == null ) {
        Swal.fire('Info', 'No se puede agregar esta actividad', 'info');
        return false;
    }

    let id          = $('#activities').val();
    let name        = $('#activities option:selected').text();

    let row         = $('<tr/>');
    let id_cell     = $('<td/>').append(
        $('<input/>', {
            class:      'form-control-plaintext',
            required:   'required',
            name:       'activities[]',
            value:      id,
            readonly:   'readonly',
        })
    );
    let name_cell   = $('<td/>').append(
        $('<input/>', {
            class:      'form-control-plaintext',
            required:   'required',
            value:      name,
            readonly:   'readonly',
        })
    );
    let reason_cell = $('<td/>').append(
        $('<input/>', {
            class:      'form-control',
            required:   'required',
            name:       'reasons[]',
        })
    );
    let btn_cell    = $('<td/>').append(
        $('<button/>', {
            class:  'btn btn-sm btn-danger',
            type:   'button',
            text:   'Retirar',
        }).on('click', function(){
            remove_row( $(this) );
        })
    );

    row.append(id_cell);
    row.append(name_cell);
    row.append(reason_cell);
    row.append(btn_cell);

    $('#table_suggestions').append(row);

    $('#activities option:selected').remove();

    if ( $('#activities').children().length == 1 ) {
        $('#btn_add_row').off();
        $('#btn_add_row').attr('disabled', true);
        $('#activities').attr('disabled', true);
    }

    $('#btn_suggest').attr('disabled', false);
}


/**
 * Remove the row selected, then add it to the select again
 */
function remove_row(element)
{
    let row     = element.closest('tr');
    let id      = row.find('td')[0].children[0].value;
    let name    = row.find('td')[1].children[0].value;

    if ( $('#activities').children().length == 1 ) {
        $('#btn_add_row').on('click', function(){
            add_row();
        });
        $('#btn_add_row').attr('disabled', false);
        $('#activities').attr('disabled', false);
    }

    $('#activities').append(
        $('<option/>', {
            value:  id,
            text:   name,
        })
    );

    row.remove();

    if ($('#table_suggestions').children().length == 0) {
        $('#btn_suggest').attr('disabled', true);
    }
}