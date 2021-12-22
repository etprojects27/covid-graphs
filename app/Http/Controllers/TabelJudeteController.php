<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use App\Models\DateCovid;
use App\Models\DateCovidJudet;
use App\Models\Judet;
use App\Models\DateTime;

class TabelJudeteController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $date_covid = DateCovid::get_last_inserted();
        // $date_covid_judete = DateCovidJudet::get_date_covid_judete();
        $date_covid_judete = DateCovidJudet::getDateJudeteLastDate();
        $date_covid_judete_7_zile = DateCovidJudet::JudeteLastWeek()->get();

        $judete = Judet::all();

        $cazuri_noi_judete = [];
        $cazuri_totale_judete = [];
        foreach ($judete as $judet) {
            $date_covid_judet = $judet->date_covid_judet()->get();
             foreach ($date_covid_judet as $key=>$data_covid_judet) {
                 $cazuri_noi_judete[$data_covid_judet->id_judet][$data_covid_judet->data] = $data_covid_judet->modificare;
                 $cazuri_totale_judete[$data_covid_judet->id_judet][$data_covid_judet->data] = $data_covid_judet->cazuri_totale;
             }  
        }

        foreach ($cazuri_noi_judete as $id_judet=>$cazuri_noi_judet) {
            //dd($cazuri_noi_judet);
            //$last_3_days_judete[$id_judet][$data] = array_sum($last_3_days);
            $cazuri_noi_judet_array = array_values($cazuri_noi_judet);
            //dd($cazuri_noi_judet_array);
            $nr = 0;
            $nr_down = count($cazuri_noi_judet);
            foreach ($cazuri_noi_judet as $data=>$caz_nou_judet) {
                $nr++;
                $nr_down--;
                if ($nr<3) {
                    $last_3_days = array_slice((array) $cazuri_noi_judet_array, $nr-1, 1);
                } else {
                    $last_3_days = array_slice((array) $cazuri_noi_judet_array, $nr-3, 3);
                }

                if ($nr<7) {
                    $last_7_days = array_slice((array) $cazuri_noi_judet_array, $nr_down, 7);
                } else {
                    $last_7_days = array_slice((array) $cazuri_noi_judet_array, $nr-7, 7);
                }

                $last_14_days = array_slice((array) $cazuri_noi_judet_array, $nr, 14);
                $last_3_days_judete[$id_judet][$data] = array_sum($last_3_days);
                $last_7_days_judete[$id_judet][$data] = array_sum($last_7_days);
                $last_14_days_judete[$id_judet][$data] = array_sum($last_14_days);
            }
            //$last_3_days_judete[$id_judet] =  
        }

        //dd($last_7_days_judete);

        return view('tabel_judete', ['date_covid' => $date_covid, 'date_covid_judete' => $date_covid_judete, 'date_covid_judete_7_zile'=>$date_covid_judete_7_zile, 'cazuri_noi_judete'=>$cazuri_noi_judete,'cazuri_totale_judete'=>$cazuri_totale_judete,
        'last_3_days_judete' => $last_3_days_judete, 'last_7_days_judete' => $last_7_days_judete, 'last_14_days_judete' => $last_14_days_judete]);
    }
    
}