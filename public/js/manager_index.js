$.when($.ready).then(function() {
    // let row_count = $('.table-row').length;

    // for (let i = 0; i < row_count; i++) {
    //     $('#' + row_count).on('click', function() {
    //         window.location()
    //     });
    // }

    $('.table-row').on('click', function() {
        alert($(this).attr('id'));
        location = '/manager/client/' + $(this).attr('id');
    });
    
});