@extends('layouts.app')

@section('content')
    <div class="col-lg-6 include-content">
    <canvas id="myChart" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>

    <script>
    let date_covid = <?php echo json_encode($date_covid_1_week); ?>;

    let label_content = '# Decese noi';

    let today = Date(Date.now());
    let today_f = moment(today).format('DD.MM.YYYY');

    bg_color_values = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(153, 102, 255, 0.2)'];
    bg_border_values = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 159, 64, 1)','rgba(153, 102, 255, 1)'];

    if (date_covid) {
        labels_array = [];
        data_array = [];
        bg_color_array = [];
        bg_border_array = [];

        Object.keys(date_covid).forEach(function(k){
            //se populeaza array-ul ce contine datele din obiectul json
            data = date_covid[k]['data'];
            data_formatted = moment(data).format('DD.MM.YYYY');
            labels_array.push(data_formatted);
            
            //se populeaza array-ul ce contine nr. de decese noi din obiectul json
            data_array.push(date_covid[k]['nr_decese_noi']);
            
            //se populeaza array-urile ce contin culorile destinate coloanelor din grafic
            bg_color_index = k % 4;
            switch (bg_color_index) {
                case 0:
                    bg_color_array.push(bg_color_values[0]);
                    bg_border_array.push(bg_border_values[0]);
                    break;
                case 1:
                    bg_color_array.push(bg_color_values[1]);
                    bg_border_array.push(bg_border_values[1]);
                    break;
                case 2:
                    bg_color_array.push(bg_color_values[2]);
                    bg_border_array.push(bg_border_values[2]);
                    break;
                case 3:
                    bg_color_array.push(bg_color_values[3]);
                    bg_border_array.push(bg_border_values[3]);
                    break;
            }
        });
   } else {
       //valorile default ale array-urilor din grafic
        let labels_array = [today_f];
        let data_array = [0];
        let bg_color_array = [bg_color_values[0]];
        let bg_border_array = [bg_border_values[0]];
    }     

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels_array,
            datasets: [{
                label: label_content,
                data: data_array,
                backgroundColor: bg_color_array,
                borderColor: bg_border_array,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                    display: true,
                    text: 'Decese noi - 7 zile'
            },
        }
    });
    </script>
    </div>

    <div class="col-lg-6 include-content">
    <canvas id="myChart2" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>

    <script>
    let label_content_2 = 'Total decese';

    if (date_covid) {
        labels_array = [];
        data_array = [];

        Object.keys(date_covid).forEach(function(k){
            //se populeaza array-ul ce contine datele din obiectul json
            data = date_covid[k]['data'];
            data_formatted = moment(data).format('DD.MM.YYYY');
            labels_array.push(data_formatted);
            
            //se populeaza array-ul ce contine nr. de teste noi din obiectul json
            data_array.push(date_covid[k]['nr_total_decese']);
        });
   } else {
       //valorile default ale array-urilor din grafic
        let labels_array = [today_f];
        let data_array = [0];
    }     


    var ctx = document.getElementById('myChart2').getContext('2d');
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
                text: 'Decese totale - 7 zile',
            },
        }
    });
    </script>
    <div>
@endsection