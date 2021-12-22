@extends('layouts.app')

@section('content')
    <?php $nr = 0; ?>

    <script>
        //let date_covid = <?php echo json_encode($date_covid_1_week); ?>;
        let today = Date(Date.now());
        let today_f = moment(today).format('DD.MM.YYYY');
        let id_judet = 0;
    </script>

    @foreach($date_covid_judete_7_zile as $date_judet)
            <div class="col-lg-3 col-lm-2 col-ls-1 include-content">
                <canvas id="myChart-<?php echo $date_judet->id_judet; ?>" style="display: block; width: 400px; height: 400px;" class="chartjs-render-monitor" width="400" height="400"></canvas>
                <script>
                    // if (date_covid) {
                    labels_array = [];
                    data_array = [];
                    judet_denumire = "";

                    //se populeaza array-ul ce contine datele din obiectul json
                    date_string = '<?php echo $date_judet->date_covid_7_zile ?>';
                    date_array = date_string.split(',');

                    cazuri_noi_string = '<?php echo $date_judet->modificare_covid_7_zile ?>';
                    data_array = cazuri_noi_string.split(',');
                    
                    for (i=0; i<date_array.length; i++) {
                        data_corecta = new Date(date_array[i]);
                        date_array[i] = moment(data_corecta).format('DD.MM');
                    }

                    id_judet = <?php echo $date_judet->id_judet; ?>;
                    judet_denumire = '<?php echo $date_judet->denumire; ?>';

                    var ctx = document.getElementById('myChart-'+ id_judet).getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels:  date_array,
                            datasets: [{
                                label: 'Cazuri noi',
                                //backgroundColor: 'rgb(255, 255, 255)',
                                borderColor: 'rgb(255, 99, 132)',
                                data:  data_array
                            }]
                        },

                        // Configuration options go here
                        options: {
                            title: {
                                display: true,
                                text: judet_denumire
                            },
                            animation: {
                                duration: 500
                            }
                        }
                    });
                </script>
                </div>
    @endforeach

@endsection