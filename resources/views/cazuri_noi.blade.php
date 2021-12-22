@extends('layouts.app')

@section('content')
    <div class="col-lg-6 include-content">
    <canvas id="myChart" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>
        <script>
            let date_covid = <?php echo json_encode($date_covid_1_week); ?>;

            //let label_content = 'Cazuri noi';

            let today = Date(Date.now());
            let today_f = moment(today).format('DD.MM.YYYY');

            if (date_covid) {
            labels_array = [];
            data_array_cazuri_noi = [];
            data_array_reconfirmari = [];
            nr_cazuri_pozitive = 0;

            Object.keys(date_covid).forEach(function(k){

                    //se populeaza array-ul ce contine nr. de cazuri noi din obiectul json
                    data_array_cazuri_noi.push(date_covid[k]['nr_cazuri_noi']);
                    data_array_reconfirmari.push(date_covid[k]['nr_cazuri_reconfirmate']);
                    nr_cazuri_pozitive = date_covid[k]['nr_cazuri_noi'] + date_covid[k]['nr_cazuri_reconfirmate'];
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
                    label: 'Cazuri noi',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    data: data_array_cazuri_noi
                }, {
                    label: 'Reconfirmari',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    data:  data_array_reconfirmari
                }],
            };

            var ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: true,
                        text: 'Cazuri pozitive - 7 zile'
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

                                // If it is not the last dataset, you display it as you usually do
                                if (tooltipItem.datasetIndex != data.datasets.length - 1) {
                                    return nr_cazuri_pozitive + " : " + valor;
                                } else { // .. else, you display the dataset and the total, using an array
                                    return [nr_cazuri_pozitive + " : " + valor, "Total : " + total];
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

    <div class="col-lg-6 include-content">
        <canvas id="myChart2" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>

        <script>
        let label_content = 'Procent infectare';

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
                
                //se populeaza array-ul ce contine nr. de cazuri noi din obiectul json
                procent_infectare = date_covid[k]['nr_cazuri_noi'] / 100000 * 100;
                data_array.push(procent_infectare.toFixed(2));
                
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
            var ctx = document.getElementById('myChart2').getContext('2d');
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
                        text: 'Procent infectare la 100000 loc - 7 zile'
                    },
                },
            });
        </script>
    </div>

    

@endsection