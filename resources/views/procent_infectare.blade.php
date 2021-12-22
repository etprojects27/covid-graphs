@extends('layouts.app')

@section('content')
    <div class="col-lg-6 include-content">
    <canvas id="myChart" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>
        <script>
            let date_covid = <?php echo json_encode($date_covid_1_week); ?>;
            
            let today = Date(Date.now());
            let today_f = moment(today).format('DD.MM.YYYY');

            if (date_covid) {
            labels_array = [];
            data_array_cazuri_noi = [];
            data_array_teste_noi = [];
            nr_cazuri_pozitive = 0;

            Object.keys(date_covid).forEach(function(k){
                    //se populeaza array-ul ce contine nr. de cazuri noi din obiectul json
                    data_array_cazuri_noi.push(date_covid[k]['nr_cazuri_noi']);
                    data_array_teste_noi.push(date_covid[k]['nr_teste_noi']);
                    procent_infectare = (date_covid[k]['nr_cazuri_noi'] / date_covid[k]['nr_teste_noi']) * 100;
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
                    label: 'Teste noi',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    data:  data_array_teste_noi
                },
                //   {
                //     type: 'line',
                //     label: 'Dataset 1',
                //     borderColor: 'rgba(153, 102, 255, 0.2)',
                //     borderWidth: 2,
                //     fill: false,
                //     data: [10,1220,3,4,5,6,7]
                //     },
                ],
            };

            var ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: true,
                        text: 'Procent infectare % - 7 zile'
                    },
                    tooltips: {
                        // mode: 'index',
                        // intersect: false
                    mode: 'label',
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var procent_infectare = data.datasets[tooltipItem.datasetIndex].label;
                                var valor = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                var procent = [];

                                // Loop through all datasets to get the actual total of the index
                                var total = 0;

                                cazuri_noi = data.datasets[0].data[tooltipItem.index];
                                teste_noi = data.datasets[1].data[tooltipItem.index];
                                procent = cazuri_noi/teste_noi * 100;
                                   

                                // If it is not the last dataset, you display it as you usually do
                                if (tooltipItem.datasetIndex != data.datasets.length - 1) {
                                    return procent_infectare + " : " + valor;
                                } else { // .. else, you display the dataset and the total, using an array
                                    return [procent_infectare + " : " + valor, "Procent infectare: " + procent.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + '%'];
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

    <div class="col-lg-5 include-content">
        <canvas id="myChart2" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>
        <script>
            labels_array = [];
      
            if (date_covid) {         
                total_apeluri_112 = 0;
                total_apeluri_telverde = 0;
                Object.keys(date_covid).forEach(function(k){
                    //se populeaza array-ul ce contine nr. de cazuri noi din obiectul json
                    total_apeluri_112 = total_apeluri_112 + date_covid[k]['nr_apeluri_urgenta'];
                    total_apeluri_telverde = total_apeluri_telverde + date_covid[k]['nr_apeluri_informare']
                    });
            } else {
            //valorile default ale array-urilor din grafic
                let labels_array = [today_f];
                let data_array = [0];
            }

            var ctx = document.getElementById('myChart2').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [total_apeluri_112, total_apeluri_telverde],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                    }],
                    labels: ['Numar unic 112', 'Telverde Covid-19']
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Total apeluri telefonice - 7 zile'
                    },
                }
            });
        </script>
@endsection