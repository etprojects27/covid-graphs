@extends('layouts.app')

@section('content')
  <div class="col-lg-8 include-content">
  <!-- Start your project here-->  
  <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="th-sm">Denumire
        </th>
        <th class="th-sm">Populatie
        </th>
        <th class="th-sm">Cazuri noi
        </th>
        <th class="th-sm">Cazuri totale
        </th>
        <th class="th-sm">Mod. proc. %
        </th>
        <th class="th-sm">Data
        </th>
        <th class="th-sm">Nr. cazuri 3 zile
        </th>
        <th class="th-sm">Nr. cazuri 7 zile
        </th>
        <th class="th-sm">Nr. cazuri 14 zile
        </th>
      </tr>
    </thead>
    <tbody>
    <?php
      //dd($date_covid_judete);
    ?>

    @if (isset($date_covid_judete))
      @foreach ($date_covid_judete as $key=>$date_covid_judet)
        <tr>
          <td> {{ $date_covid_judet->judet->denumire }} </td>
          <td> {{ $date_covid_judet->judet->populatie }} </td>
          <?php
            $cazuri_noi = 0;
            if (isset($date_covid_judet->cazuri_totale_yesterday)) {
              $cazuri_noi = $date_covid_judet->cazuri_totale - $date_covid_judet->cazuri_totale_yesterday;
            }
            if (isset($cazuri_noi_judete)) {
              $cazuri_noi = $cazuri_noi_judete[$date_covid_judet->id_judet][$date_covid_judet->data];
            }
          ?>
          <td>
            @if ($cazuri_noi > 0)
              <i class="fa fa-plus" aria-hidden="true" style="color:#cc0066"></i>
            @elseif($cazuri_noi == 0)
              <i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>
            @elseif($cazuri_noi < 0)
              <i class="fa fa-arrow-down" aria-hidden="true" style="color:#009933"></i>
            @endif
              {{ $cazuri_noi }}
          </td>
          <td>{{ $date_covid_judet->cazuri_totale }}</td>
          <td>
            @if (isset($cazuri_totale_judete))
              <?php
                  //$modif_proc = ($date_covid_judet->cazuri_totale_yesterday) ? (($cazuri_noi * 100) / $date_covid_judet->cazuri_totale_yesterday) : 0;
                  $previous_date = new DateTime($date_covid_judet->data);
                  date_sub($previous_date, date_interval_create_from_date_string("1 days"));
                  $previous_date_judet = $previous_date->format('Y-m-d');

                  $modif_proc = 0;
                  if (isset($cazuri_totale_judete[$date_covid_judet->id_judet][$previous_date_judet])) {
                    $modif_proc = ($cazuri_totale_judete[$date_covid_judet->id_judet][$previous_date_judet]) ? (($cazuri_noi_judete[$date_covid_judet->id_judet][$date_covid_judet->data] * 100) / $cazuri_totale_judete[$date_covid_judet->id_judet][$previous_date_judet]) : 0;
                  }         
              ?>
              @if ($modif_proc > 0)
                <i class="fa fa-arrow-up" aria-hidden="true" style="color:#cc0066"></i>
              @elseif ($modif_proc < 0)
                <i class="fa fa-arrow-down" aria-hidden="true" style="color:#009933"></i>
              @elseif ($modif_proc == 0)
                <i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>
              @endif
              {{ number_format($modif_proc, 2, ".",",") }} 
            @endif
          </td>
          <td>
              @if (isset($date_covid_judet->data))
                <?php
                  $date = new DateTime($date_covid_judet->data);
                  $data = $date->format('d.m.Y');
                ?>
                  {{ $data }}
              @endif
          </td>
          <td>
            {{ $last_3_days_judete[$date_covid_judet->id_judet][$date_covid_judet->data] }}
          </td>
          <td>
            {{ $last_7_days_judete[$date_covid_judet->id_judet][$date_covid_judet->data] }}
          </td>
          <td>
            {{ $date_covid_judet->nr_total_cazuri_14 }}
          </td>
        </tr>
      @endforeach
    @endif
    </tbody>
    <tfoot>
      <tr>
        <th>Denumire
        </th>
        <th>Populatie
        </th>
        <th>Cazuri noi
        </th>
        <th>Cazuri totale
        </th>
        <th>Mod. proc. %
        </th>
        <th>Data
        </th>
        <th>Nr. cazuri 3 zile
        </th>
        <th>Nr. cazuri 7 zile
        </th>
        <th>Nr. cazuri 14 zile
        </th>
      </tr>
    </tfoot>
  </table>
    <!-- End your project here-->
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
          "paging": true,
          "searching": true,
          "ordering": true,
          "order": [[ 5, "desc" ]]
        });
        $('.dataTables_length').addClass('bs-select');
      });
    </script>
@endsection


