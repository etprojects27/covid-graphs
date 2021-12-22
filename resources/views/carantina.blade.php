@extends('layouts.app')

@section('content')
<div class="col-lg-6 include-content">
    <canvas id="myChart2" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>
        <script>
            let date_covid = <?php echo json_encode($date_covid_1_week); ?>;
            let today = Date(Date.now());
            let today_f = moment(today).format('DD.MM.YYYY');

            if (date_covid) {
            labels_array = [];
            data_array_izolare_domiciliu = [];
            data_array_izolare_inst = [];
            nr_cazuri_izolare = 0;

            Object.keys(date_covid).forEach(function(k){
                    //se populeaza array-ul ce contine nr. de cazuri noi din obiectul json
                    data_array_izolare_domiciliu.push(date_covid[k]['nr_izolare_domiciliu']);
                    data_array_izolare_inst.push(date_covid[k]['nr_izolare_inst']);
                    nr_cazuri_izolare = date_covid[k]['nr_izolare_domiciliu'] + date_covid[k]['nr_izolare_inst'];
                    //se populeaza array-ul ce contine datele din obiectul json
                    data = date_covid[k]['data'];
                    data_formatted = moment(data).format('DD.MM.YYYY');

                    label_content = data_formatted;
                    labels_array.push(label_content);
                });
            } else {
                //valorile default ale array-urilor din grafic
                    let labels_array = [today_f];
                    let data_array_izolare_domiciliu = [0];
                    let data_array_izolare_inst = [0];
            }
            console.log(data_array_izolare_domiciliu);

            var barChartData = {
                labels: labels_array,
                datasets: [{
                    label: 'Izolare la domiciliu',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    data: data_array_izolare_domiciliu
                }, {
                    label: 'Izolare institutionalizata',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    data:  data_array_izolare_inst
                }],
            };

            var ctx = document.getElementById('myChart2').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: true,
                        text: 'Nr. persoane izolate - 7 zile',
                    },
                    tooltips: {
                        mode: 'label',
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var nr_cazuri_izolare = data.datasets[tooltipItem.datasetIndex].label;
                                var valor = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                                // Loop through all datasets to get the actual total of the index
                                var total = 0;
                                for (var i = 0; i < data.datasets.length; i++)
                                total += data.datasets[i].data[tooltipItem.index];

                                // If it is not the last dataset, you display it as you usually do
                                if (tooltipItem.datasetIndex != data.datasets.length - 1) {
                                    return nr_cazuri_izolare + " : " + valor;
                                } else { // .. else, you display the dataset and the total, using an array
                                    return [nr_cazuri_izolare + " : " + valor, "Total : " + total];
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
    <canvas id="myChart" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>
    
    <script>
    let label_content = ' Nr. persoane carantina';

    if (date_covid) {
            labels_array = [];
            data_array_carantina_domiciliu = [];
            data_array_carantina_inst = [];
            nr_cazuri_izolare = 0;

            Object.keys(date_covid).forEach(function(k){
                    //se populeaza array-ul ce contine nr. de cazuri noi din obiectul json
                    data_array_carantina_domiciliu.push(date_covid[k]['nr_carantina_domiciliu']);
                    data_array_carantina_inst.push(date_covid[k]['nr_carantina_inst']);
                    nr_cazuri_izolare = date_covid[k]['nr_carantina_domiciliu'] + date_covid[k]['nr_carantina_inst'];
                    //se populeaza array-ul ce contine datele din obiectul json
                    data = date_covid[k]['data'];
                    data_formatted = moment(data).format('DD.MM.YYYY');

                    label_content = data_formatted;
                    labels_array.push(label_content);
                });
            } else {
                //valorile default ale array-urilor din grafic
                    let labels_array = [today_f];
                    let data_array_carantina_domiciliu = [0];
                    let data_array_carantina_inst = [0];
            }
            console.log(data_array_carantina_domiciliu);

            var barChartData = {
                labels: labels_array,
                datasets: [{
                    label: 'Carantina la domiciliu',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    data: data_array_carantina_domiciliu
                }, {
                    label: 'Carantina institutionalizata',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    data:  data_array_carantina_inst
                }],
            };

            var ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: true,
                        text: 'Nr. persoane carantina - 7 zile',
                    },
                    tooltips: {
                        mode: 'label',
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var nr_cazuri_carantina = data.datasets[tooltipItem.datasetIndex].label;
                                var valor = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                                // Loop through all datasets to get the actual total of the index
                                var total = 0;
                                for (var i = 0; i < data.datasets.length; i++)
                                total += data.datasets[i].data[tooltipItem.index];

                                // If it is not the last dataset, you display it as you usually do
                                if (tooltipItem.datasetIndex != data.datasets.length - 1) {
                                    return nr_cazuri_carantina + " : " + valor;
                                } else { // .. else, you display the dataset and the total, using an array
                                    return [nr_cazuri_carantina + " : " + valor, "Total : " + total];
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