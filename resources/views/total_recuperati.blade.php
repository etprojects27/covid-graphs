@extends('layouts.app')

@section('content')
    <div class="col-lg-6 include-content">
    <canvas id="myChart" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>

    <script>
    let date_covid = <?php echo json_encode($date_covid_1_week); ?>;
    let label_content = '# Total recuperati';
    let today = Date(Date.now());
    let today_f = moment(today).format('DD.MM.YYYY');

    if (date_covid) {
        labels_array = [];
        data_array = [];

        Object.keys(date_covid).forEach(function(k){
            //se populeaza array-ul ce contine datele din obiectul json
            data = date_covid[k]['data'];
            data_formatted = moment(data).format('DD.MM.YYYY');
            labels_array.push(data_formatted);
            
            //se populeaza array-ul ce contine nr. de teste noi din obiectul json
            data_array.push(date_covid[k]['nr_total_recuperati']);
        });
   } else {
       //valorile default ale array-urilor din grafic
        let labels_array = [today_f];
        let data_array = [0];
    }     


    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: labels_array,
            datasets: [{
                label: label_content,
                //backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data:  data_array
            }]
        },

        // Configuration options go here
        options: {}
    });
    </script>
    <div>
@endsection