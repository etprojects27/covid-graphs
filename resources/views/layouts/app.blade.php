<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Grafice covid</title>
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.css">

        <!-- Scripts -->
        <script src="\js\Chart.bundle.js"></script>
        <script src="\js\chartjs-plugin-datalabels.js"></script>
        <script src="\js\moment.min.js"></script>
        
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.0/sl-1.3.1/datatables.min.css"/>


        <style>
        .selector-for-some-widget {
            box-sizing: content-box;
        }
        body {
            font-family: Nunito,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        }
        .info {
            padding: 0.1rem;
            background-color: #ffffff;
            height:auto;
        }
        .info-last {
            margin-left: 0px !important;
        }
        .info-content {
            padding-left:0.8rem;
            height:auto;
            min-height:5rem;
            word-break: break-word;
        }
        .border-red {
            border: 1px solid red;
        }
        .border-blue {
            border: 1px solid blue;
        }
        .border-green {
            border: 1px solid green;
        }
        .border-yellow {
            border: 1px solid yellow;
        }
        .border-grey {
            border: 1px solid rgba(58,59,69,.15);
        }
        .border-left-primary {
            border-left: .25rem solid #4e73df !important;
        }
        .border-left-success {
            border-left: .25rem solid #1cc88a !important;
        }
        .border-left-info {
            border-left: .25rem solid #36b9cc !important;
        }
        .border-left-warning {
            border-left: .25rem solid #f6c23e !important;
        }
        .bg-color-grey{
            background-color:#f8f9fc;
        }
        .text-primary {
            color: #4e73df !important;
        }
        .text-success {
            color: #1cc88a !important;
        }
        .text-info {
            color: #36b9cc !important;
        }
        .text-warning {
            color: #f6c23e !important;
        }
        .info-number {
            padding-top:0.8rem;
        }
        .info-icon {
            padding-top:1.2rem;
        }
        .font-awsome-style {
            font-size:2.2rem;
        }
        .font-awsome-style-2 {
            font-size:2.5rem;
        }
        .sidebar {
            margin-left:0.2rem;
        }
        .menu-item{
            border-top: 1px solid rgba(0,0,0,.125);
            display: block;
            padding: .75rem 1.25rem;
            color: black;
            word-break: break-word;
            background-color: #f8f9fa !important;
        }
        .sidebar-heading {
            height:4.90rem;
        }
        .sidebar-heading-image {
            max-width: 80%;
            max-height: 100%;
            display: block;
            margin-left:auto;
            margin-right:auto;
            padding-top:0.4rem;
        }
        .list-group-item-action {
            width: 100%;
            color: #495057;
            text-align: inherit;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }
  
        .chartjs-render-monitor {
             animation: chartjs-render-animation 1ms;
             animation-name: chartjs-render-animation;
             animation-duration: 2ms;
             animation-timing-function: ease;
             animation-delay: 0s;
             animation-iteration-count: 1;
             animation-direction: normal;
             animation-fill-mode: none;
             animation-play-state: running;
        }

        .include-content {
            margin-top: 25px;
        }

        #data_th {
            background-color: #ffe5db;    
        }
        
        </style>
    </head>
    <body>
        <div class="container-fluid bg-color-grey" style="margin-top:2rem" >
            <div class="row">
                <div class="col-2 col-sm-2 col-md-2 col-lg-2 info">
                    <div class="border-grey rounded sidebar">
                        <div class="sidebar-heading">
                            <img class="sidebar-heading-image" src='{{ asset("images/COVID-19-3.jpg") }}'></img>
                        </div>
                        <div class="list-group">
                            <row>
                                <?php 
                                    $route = Route::currentRouteName();
                                ?>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'cazuri_noi.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('cazuri_noi.view') }}"><i class="fa fa-users text-center" style="color:#4e73df; width:1.3rem"></i> Cazuri noi </a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'teste_noi.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('teste_noi.view') }}"><i class="fa fa-plus-square text-center" style="color:#47c88a; width:1.3rem"></i> Teste noi</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'procent_infectare.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('procent_infectare.view') }}"><i class="fa fa-percent text-center" style="color:#36b9cc; width:1.3rem"></i> Procent infectare</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'ati.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('ati.view') }}"><i class="fa fa fa-bed text-center" style="color:#f6c23e; width:1.3rem"></i> ATI</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'decese_noi.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('decese_noi.view') }}"><i class="fa fa-power-off text-center" style="color:#3366cc; width:1.3rem"></i> Decese noi</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'total_cazuri.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('total_cazuri.view') }} "><i class="fa fa-bar-chart text-center" style="color:orange; width:1.3rem"></i> Total cazuri</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'carantina.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('carantina.view') }} "><i class="fa fa-home" style="color:#6600ff; width:1.3rem; font-size:1.3rem"></i> Carantina</a>
                                
                                <!-- <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'total_cazuri.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('total_cazuri.view') }} "><i class="fa fa-bar-chart text-center" style="color:orange; width:1.3rem"></i> Total cazuri</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'total_recuperati.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('total_recuperati.view') }} "><i class="fa fa-bar-chart text-center" style="color:orange; width:1.3rem"></i> Total recuperati</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'total_decese.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('total_decese.view') }} "><i class="fa fa-bar-chart text-center" style="color:orange; width:1.3rem"></i> Total decese</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'total_teste.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('total_teste.view') }} "><i class="fa fa-bar-chart text-center" style="color:orange; width:1.3rem"></i> Total teste</a> -->
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'cazuri_noi_judete.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('cazuri_noi_judete.view') }} "><i class="fa fa-users" style="color:#4e73df; width:1.3rem;"></i> Cazuri noi Judete</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'cazuri_totale_judete.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('cazuri_totale_judete.view') }} "><i class="fa fa-bar-chart" style="color:orange; width:1.3rem;"></i> Total cazuri Judete</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'procent_infectare_judete.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('procent_infectare_judete.view') }} "><i class="fa fa-percent" style="color:#36b9cc; width:1.3rem;"></i> Procent infectati Judete</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'tabel_judete.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('tabel_judete.view') }} "><i class="fa fa-table text-center" style="color:red; width:1.3rem"></i> Tabel judete</a>
                                <a class="list-group-item list-group-item-action text-uppercase font-weight-bold {{ ($route == 'tabel_date.view') ? 'list-group-item-secondary' : 'bg-light menu-item' }}"  href=" {{ route('tabel_date.view') }} "><i class="fa fa-table text-center" style="color:#4e73df; width:1.3rem"></i> Tabel date</a>
                            </row>
                        </div>
                    </div>
                </div>
                <?php 
                    $cazuri_noi = 0;
                    $teste_noi = 0;
                    $rata_infectare = 0;
                    $ati = 0;
                    $data = date("d.m.Y");

                    if (isset($date_covid)) {
                        $cazuri_noi = $date_covid->nr_cazuri_noi;
                        $teste_noi = $date_covid->nr_teste_noi;
                        $rata_infectare = ($teste_noi) ? ($cazuri_noi / $teste_noi) * 100 : 0;
                        $ati = $date_covid->nr_total_activi_ati;
                        if (isset($date_covid->data)) {
                            $date = new DateTime($date_covid->data);
                            $data = $date->format('d.m.Y');
                        }
                    }
                ?>

                <div class="col-10 col-sm-10 col-md-10 col-lg-10" style="height:auto">
                    <div class="row">
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 info">
                            <div class="border-grey border-left-primary shadow  rounded info-content position:relative  overflow:hidden">
                                <div class="flex-row d-flex" style="min-width:30px; margin-left:0; margin-right:0;padding-right:2px;">
                                    <div class="flex mr-auto ">
                                        <div class="text-uppercase text-primary font-weight-bold">Cazuri noi</div>
                                        <div class="info-number"><span class="font-weight-bold">{{ $cazuri_noi }}</span> - {{ $data }}</div>
                                    </div>
                                    <div class="flex ml-auto info-icon" style="padding-left:0px; padding-right:0px;">
                                        <p><i class="fa fa-users font-awsome-style"></i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-3 col-sm-3 col-md-3 col-lg-3 info" style="width:100%;">
                            <div class="border-grey border-left-primary shadow  rounded info-content position:relative  overflow:hidden">
                                <div class="row" style="min-width:30px; margin-left:0; margin-right:0;">
                                    <div class="col-3 col-sm-5 col-md-5 col-lg-9">
                                        <div class="text-uppercase text-primary font-weight-bold">Cazuri noi</div>
                                        <div class="info-number font-weight-bold">1230</div>
                                    </div>
                                    <div class="col-3 col-sm-5 col-md-5 col-lg-3 info-icon" >
                                        <p><i class="fa fa-users font-awsome-style"></i></p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 info">
                            <div class="border-grey border-left-success shadow  rounded info-content">
                                <div class="flex-row d-flex" style="min-width:30px; margin-left:0; margin-right:0;padding-right:2px;">
                                    <div class="flex mr-auto">
                                        <div class="text-uppercase text-success font-weight-bold">Teste noi</div>
                                        <div class="info-number"><span class="font-weight-bold">{{ $teste_noi }}</span> - {{ $data }}</div>
                                    </div>
                                    <div class="flex ml-auto info-icon" style="padding-left:0px; padding-right:0px;">
                                        <p class="text-center"><i class="fa fa-plus-square font-awsome-style-2 text-center"></i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 info">
                            <div class="border-grey border-left-info shadow  rounded info-content">
                                <div class="flex-row d-flex" style="min-width:30px; margin-left:0; margin-right:0;padding-right:2px;">
                                    <div class="flex mr-auto">
                                        <div class="text-uppercase text-info font-weight-bold">Procent infectare</div>
                                        <div class="info-number"><span class="font-weight-bold">{{ number_format($rata_infectare, 2, ",",".")}} % </span>- {{ $data }}</div>
                                    </div>
                                    <div class="flex ml-auto info-icon" style="padding-left:0px; padding-right:0px;">
                                        <p class="text-center"><i class="fa fa-percent font-awsome-style text-center"></i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 info">
                            <div class="border-grey border-left-warning shadow  rounded info-content">
                                <div class="flex-row d-flex" style="min-width:30px; margin-left:0; margin-right:0;padding-right:2px;">
                                    <div class="flex mr-auto">
                                        <div class="text-uppercase text-warning font-weight-bold">ATI</div>
                                        <div class="info-number "> <span class="font-weight-bold">{{ $ati }}</span> - {{ $data }}</div>
                                    </div>
                                    <div class="flex ml-auto info-icon" style="padding-left:0px; padding-right:0px;">
                                        <p class="text-center"><i class="fa fa-bed font-awsome-style text-center"></i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @yield('content')
                    </div>
                </div>

                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.0/sl-1.3.1/datatables.min.js"></script>

        @yield('scripts')
    </body>
</html>
