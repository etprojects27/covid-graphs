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
            data_array.push(date_covid[k]['nr_total_activi_ati']);
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
                text: 'ATI - 7 zile'
            },
        }
    });
    </script>
</div>
<div class="col-lg-6 include-content">
    <canvas id="myChart2" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>
        <script>
            if (date_covid) {
            labels_array = [];
            data_array_paturi_ocupate = [];
            data_array_paturi_libere = [];
            nr_cazuri_pozitive = 0;

            Object.keys(date_covid).forEach(function(k){

                    //se populeaza array-ul ce contine nr. de cazuri noi din obiectul json
                    data_array_paturi_ocupate.push(date_covid[k]['nr_total_activi_ati']);
                    data_array_paturi_libere.push(1050 - date_covid[k]['nr_total_activi_ati']);

                    //se populeaza array-ul ce contine datele din obiectul json
                    data = date_covid[k]['data'];
                    data_formatted = moment(data).format('DD.MM.YYYY');

                    label_content = data_formatted;
                    labels_array.push(label_content);
                });
                } else {
                    //valorile default ale array-urilor din grafic
                        let labels_array = [today_f];
                        let data_array = [0];
                    }     

            var barChartData = {
                labels: labels_array,
                datasets: [{
                    label: 'Paturi ocupate',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    data: data_array_paturi_ocupate
                }, {
                    label: 'Paturi libere',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    data:  data_array_paturi_libere
                }],
            };

            var ctx = document.getElementById('myChart2').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: true,
                        text: 'Rata ocupare - 7 zile'
                    },
                    tooltips: {
                        // mode: 'index',
                        // intersect: false
                    mode: 'label',
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var nr_cazuri_pozitive = data.datasets[tooltipItem.datasetIndex].label;
                                var valor = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                                // Loop through all datasets to get the actual total of the index
                                var total = 0;
                                for (var i = 0; i < data.datasets.length; i++)
                                total += data.datasets[i].data[tooltipItem.index];

                                cazuri_noi = data.datasets[0].data[tooltipItem.index];
                                //teste_noi = data.datasets[1].data[tooltipItem.index];
                                procent = cazuri_noi/1050 * 100;

                                // If it is not the last dataset, you display it as you usually do
                                if (tooltipItem.datasetIndex != data.datasets.length - 1) {
                                    return nr_cazuri_pozitive + " : " + valor;
                                } else { // .. else, you display the dataset and the total, using an array
                                    return [nr_cazuri_pozitive + " : " + valor, "Total : 1050", "Rata ocupare : " + procent.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + '%'];
                                }
                            }
                        }
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
        });
        </script>
    </div>
@endsection