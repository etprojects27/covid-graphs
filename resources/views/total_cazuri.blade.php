@extends('layouts.app')

@section('content')
<div class="col-lg-6 include-content">
    <canvas id="myChart" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>

    <script>
    let date_covid = <?php echo json_encode($date_covid_1_week); ?>;
    let label_content_2 = 'Total cazuri';
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
            data_array.push(date_covid[k]['nr_total_cazuri']);
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
                label: label_content_2,
                //backgroundColor: 'rgb(255, 255, 255)',
                borderColor: 'rgb(255, 99, 132)',
                data:  data_array
            }]
        },

        // Configuration options go here
        options: {
            title: {
                display: true,
                text: 'Total cazuri - 7 zile'
            },
        }
    });
    </script>
    </div>

    <div class="col-lg-6 include-content">
    <canvas id="myChart2" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>

    <script>
    let label_content = '# Total cazuri';

    if (date_covid) {
        labels_array = [];
        data_array = [];
        data_array_2 = [];
        data_array_3 = [];

        Object.keys(date_covid).forEach(function(k){
            //se populeaza array-ul ce contine datele din obiectul json
            data = date_covid[k]['data'];
            data_formatted = moment(data).format('DD.MM.YYYY');
            labels_array.push(data_formatted);
            
            //se populeaza array-ul ce contine nr. de teste noi din obiectul json
            data_array.push(date_covid[k]['nr_total_cazuri']);
            data_array_2.push(date_covid[k]['nr_total_recuperati']);
            data_array_3.push(date_covid[k]['nr_total_decese']);
        });
   } else {
       //valorile default ale array-urilor din grafic
        let labels_array = [today_f];
        let data_array = [0];
        let data_array_2 = [0];
        let data_array_3 = [0];
    }     


    var ctx = document.getElementById('myChart2').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: labels_array,
            datasets: [{
                label: 'Nr. total cazuri',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: data_array,
                fill: false,
            }, {
                label: 'Nr. total recuperari',
                fill: false,
                borderColor: 'rgb(51, 204, 51)',
                data: data_array_2,
            }, {
                label: 'Nr. total decese',
                fill: false,
                borderColor: 'rgb(51, 51, 255)',
                data: data_array_3,
            }]
         },

        // Configuration options go here
        options: { 
            title: {
                display: true,
                text: 'Anazliza cazuri - 7 zile'
            },
        }
    });
    </script>
    </div>
    
    
@endsection