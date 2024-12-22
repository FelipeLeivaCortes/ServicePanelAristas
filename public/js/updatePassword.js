
$(document).ready(function(){
    let new_pass       = $('#new_pass');
    let confirm_pass   = $('#confirm_pass');

    new_pass.on('keyup', function(){
        let triger_length   = false,
            triger_equals   = false;

        if ( $(this).val().length > 7 )
            triger_length   = true;


        if ( $(this).val() == confirm_pass.val() )
            triger_equals   = true;

        let disabled    = ( triger_length && triger_equals ) ? null : 'disabled';
        
        $('#btn_send').prop('disabled', disabled);

    });

    confirm_pass.on('keyup', function(){
        let triger_length   = false,
            triger_equals   = false;

        if ( $(this).val().length > 7 )
            triger_length   = true;


        if ( $(this).val() == new_pass.val() )
            triger_equals   = true;

        let disabled    = ( triger_length && triger_equals ) ? null : 'disabled';

        $('#btn_send').prop('disabled', disabled);
    });


});