// Bulk delete comfirmation
$('body').on('click','.bulk_delete_confirmation', function (e) {
    e.preventDefault();
    $(document).find('#bulk_delete_modal').attr('action', $(this).attr('data-action'));
});

// Delete confirmation
$('body').on('click','.delete_confirmation', function (e) {
    e.preventDefault();
    $(document).find('#delete_modal').attr('action', $(this).attr('data-action'));
});

// Check all box
$('body').on('click', '#check_all', function () {
    $('.checkbox').not(this).prop('checked', this.checked);
});
