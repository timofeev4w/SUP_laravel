$.when($.ready).then(function() {
    $('.btn-check, .date, #city').on('change', function(){
        $('#filter').trigger('submit');
    });

    $('.table-row').on('click', function() {
        location = '/manager/client/' + $(this).attr('id');
    });
    
});
