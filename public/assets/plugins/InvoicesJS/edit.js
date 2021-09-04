

    // edit JS section
$('#editSection').on('show.bs.modal' , function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var name = button.data('name')
    var description = button.data('description')
    var modal = $(this)
    modal.find('.modal-body #section_id').val(id);
    modal.find('.modal-body #section_name').val(name);
    modal.find('.modal-body #section_description').val(description);
})

    // delete JS Sections
$('#deleteModel').on('show.bs.modal' , function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var name = button.data('name')
    var modal = $(this)
    modal.find('.modal-body #section_id').val(id);
    modal.find('.modal-body #section_name').val(name);
})


    // edit JS product
    $('#editProduct').on('show.bs.modal' , function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #product_id').val(id);
        modal.find('.modal-body #product_name').val(name);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #product_description').val(description);
    })



        // delete JS Product
    $('#deleteProduct').on('show.bs.modal' , function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('product_name')
        var modal = $(this)
        modal.find('.modal-body #product_id').val(id);
        modal.find('.modal-body #product_name').val(name);
    })


        // delete Modal Attachments
        $('#file_delete').on('show.bs.modal' , function (event) {
            var button = $(event.relatedTarget)
            var file_id = button.data('file_id')
            var file_name = button.data('file_name')
            var invoices_number = button.data('invoices_number')
            var modal = $(this)
            modal.find('.modal-body #file_id').val(file_id);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoices_number').val(invoices_number);
        })

    // delete Modal invoices
        $('#delete_invoices').on('show.bs.modal' , function (event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    // Archive Modal invoices
        $('#archive_invoices').on('show.bs.modal' , function (event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    // restore invoices Modal
    $('#restore_invoices').on('show.bs.modal' , function (event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })

    function printDiv(){
        var printContent = document.getElementById('print').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload();
    }

