$.when($.ready).then(function() {
    $('.date').on('change', function(){
        $('#filter').trigger('submit');
    });

    let result = [];
    result.push(['Дата', 'Клиенты']);

    days.forEach(function(item, index, array) {
        result.push([item[1]['date'], item[1]['count']]);
    });

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(result);

        var options = {
            title: 'Статистика клиентов',
            vAxis: {title: 'Кол-во'},
            isStacked: true
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('clients'));

        chart.draw(data, options);
    }
});
