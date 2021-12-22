@extends('layouts.app')

@section('content')
  <div class="col-lg-8 include-content">
  <!-- Start your project here-->  
  <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="th-sm">Data
        </th>
        <th class="th-sm">Nr. cazuri zi
        </th>
        <th class="th-sm">Nr. total cazuri
        </th>
        <th class="th-sm">Nr. teste zi
        </th>
        <th class="th-sm">Nr. total teste
        </th>
        <th class="th-sm">Procent infectare
        </th>
        <th class="th-sm">Nr. total ATI
        </th>
        <th class="th-sm">Nr. recuperati zi
        </th>
        <th class="th-sm">Nr. total recuperati
        </th>
        <th class="th-sm">Nr. decese zi
        </th>
        <th class="th-sm">Nr. total decese
        </th>
      </tr>
    </thead>
    <tbody>

    @if (isset($date_covid_table))
        <?php
           $prev_nr_cazuri_noi = 0;
        ?>

      @foreach ($date_covid_table as $key => $date_covid_line)
        <?php
          $procent_infectare = $date_covid_line->nr_cazuri_noi / $date_covid_line->nr_teste_noi * 100;

          //valorile anterioare ale coloanelor pentru fiecare inregistrare in parte
          if (isset($date_covid_table[$key-1])) {
            $difference_cazuri_noi = $date_covid_line->nr_cazuri_noi - $date_covid_table[$key-1]->nr_cazuri_noi;          
            $difference_teste_noi = $date_covid_line->nr_teste_noi - $date_covid_table[$key-1]->nr_teste_noi;
            $difference_nr_total_activi_ati = $date_covid_line->nr_total_activi_ati - $date_covid_table[$key-1]->nr_total_activi_ati;
            $difference_recuperati_noi = $date_covid_line->nr_recuperati_noi - $date_covid_table[$key-1]->nr_recuperati_noi;
            $difference_decese_noi = $date_covid_line->nr_decese_noi - $date_covid_table[$key-1]->nr_decese_noi;

            $prev_procent_infectare = $date_covid_table[$key-1]->nr_cazuri_noi / $date_covid_table[$key-1]->nr_teste_noi * 100;
            $difference_procent_infectare = $procent_infectare - $prev_procent_infectare;
          } 
        ?>
        <tr>
          <td  id="data_td"> 
            @if (isset($date_covid_line->data))
                <?php
                  $date = new DateTime($date_covid_line->data);
                  $data = $date->format('d.m.Y');
                ?>
                  {{ $data }}
              @endif
          </td>
          <td id="cazuri_noi_td">
              @if (isset($difference_cazuri_noi))
              <?php
                switch (true) {
                    case ($difference_cazuri_noi < 0) :
                        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="color:#cc0066"></i>';
                        break;
                    case ($difference_cazuri_noi > 0) :
                        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="color:#009933"></i>';
                        break;
                    case ($difference_cazuri_noi == 0) :
                        echo '<i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>';
                        break;
                  }
              ?>
              @else
                <i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>
              @endif
          
              {{ $date_covid_line->nr_cazuri_noi }}
          </td>

          <td id="total_cazuri_td">{{ $date_covid_line->nr_total_cazuri }}</td>

          <td id="teste_noi_td">
              @if (isset($difference_teste_noi))
                <?php
                  switch (true) {
                    case ($difference_teste_noi < 0) :
                        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="color:#cc0066"></i>';
                        break;
                    case ($difference_teste_noi > 0) :
                        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="color:#009933"></i>';
                        break;
                    case ($difference_teste_noi == 0) :
                        echo '<i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>';
                        break;
                  }
                ?>
              @else
                <i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>
              @endif

            {{ $date_covid_line->nr_teste_noi }}
          </td>

          <td id="total_teste_td">{{ $date_covid_line->nr_total_teste }}</td>

          <td id="total_teste_td">
            @if (isset($difference_procent_infectare))
              <?php
                  switch (true) {
                    case ($difference_procent_infectare < 0) :
                        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="color:#cc0066"></i>';
                        break;
                    case ($difference_procent_infectare > 0) :
                        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="color:#009933"></i>';
                        break;
                    case ($difference_procent_infectare == 0) :
                        echo '<i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>';
                        break;
                  }
                ?>
              @else
                <i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>
              @endif
            {{ number_format($procent_infectare,2,',','.') }} %
          </td>

          <td id="total_activi_td">
            @if (isset($difference_nr_total_activi_ati))
              <?php
                  switch (true) {
                        case ($difference_nr_total_activi_ati < 0) :
                            echo '<i class="fa fa-arrow-down" aria-hidden="true" style="color:#cc0066"></i>';
                            break;
                        case ($difference_nr_total_activi_ati > 0) :
                            echo '<i class="fa fa-arrow-up" aria-hidden="true" style="color:#009933"></i>';
                            break;
                        case ($difference_nr_total_activi_ati == 0) :
                            echo '<i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>';
                            break;
                    }
                ?>
              @else
                <i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>
              @endif

            {{ $date_covid_line->nr_total_activi_ati }}
          </td>

          <td id="nr_recuperati_noi_td">
            @if (isset($difference_recuperati_noi))
              <?php
                switch (true) {
                    case ($difference_recuperati_noi < 0) :
                        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="color:#cc0066"></i>';
                        break;
                    case ($difference_recuperati_noi > 0) :
                        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="color:#009933"></i>';
                        break;
                    case ($difference_recuperati_noi == 0) :
                        echo '<i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>';
                        break;
                    }
                ?>
              @else
                <i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>
              @endif

            {{ $date_covid_line->nr_recuperati_noi }}
          </td>

          <td id="nr_total_recuperati_td">{{ $date_covid_line->nr_total_recuperati }}</td>

          <td id="nr_decese_noi_td">
            @if (isset($difference_decese_noi))
              <?php
                switch (true) {
                    case ($difference_decese_noi < 0) :
                        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="color:#cc0066"></i>';
                        break;
                    case ($difference_decese_noi > 0) :
                        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="color:#009933"></i>';
                        break;
                    case ($difference_decese_noi == 0) :
                        echo '<i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>';
                        break;
                   }
                ?>
              @else
                <i class="fa fa-arrows-h" aria-hidden="true" style="color:#0066ff"></i>
              @endif
            {{ $date_covid_line->nr_decese_noi }}
          </td>

          <td id="nr_total_decese_td">{{ $date_covid_line->nr_total_decese }}</td>  
        </tr>
      @endforeach

    @endif
    </tbody>
    <tfoot>
      <tr>
      <th class="th-sm">Data
        </th>
        <th class="th-sm">Nr. cazuri
        </th>
        <th class="th-sm">Nr. total cazuri
        </th>
        <th class="th-sm">Nr. teste
        </th>
        <th class="th-sm">Nr. total teste
        </th>
        <th class="th-sm">Procent infectare
        </th>
        <th class="th-sm">Nr. total ATI
        </th>
        <th class="th-sm">Nr. recuperati
        </th>
        <th class="th-sm">Nr. total recuperati
        </th>
        <th class="th-sm">Nr. decese
        </th>
        <th class="th-sm">Nr. total decese
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
          "order": [[ 0, "desc" ]]
        });
        $('.dataTables_length').addClass('bs-select');
      });
    </script>
@endsection