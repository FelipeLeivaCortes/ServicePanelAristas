$(document).ready(function() {
    $('#company_id').on('change', function() {
        const currentWidth = $(this).width();
        $(this).find('option[value=""]').remove();
        $(this).width(currentWidth);
    });
});