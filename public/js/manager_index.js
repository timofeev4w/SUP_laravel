$.when($.ready).then(function() {
    // $('.btn-filter').on('click', function() {
    //     let btn_id = $(this).attr('id');
    //     if (btn_id == 'created_at' || btn_id == 'updated_at') {
    //         location = '/manager?page=' + current_page + '&sortby=' + $(this).attr('id');
    //     }
    // });
    $('.btn-check, .date').on('change', function(){
        $('#filter').trigger('submit');
    });

    $('.table-row').on('click', function() {
        location = '/manager/client/' + $(this).attr('id');
    });
    
});

// alert(location.href);