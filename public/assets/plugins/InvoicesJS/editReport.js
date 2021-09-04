$(document).ready(function(){
    $('#invoices_number').hide();

    $('input[type="radio"]').click(function(){
        if ($(this).attr('id') == 'typ_div') {
            $('#invoices_number').hide();
            $('#type').show();
            $('#start_at').show();
            $('#end_at').show();

        } else {
            $('#invoices_number').show();
            $('#type').hide();
            $('#start_at').hide();
            $('#end_at').hide();
        }
    });
})
