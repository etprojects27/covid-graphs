<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\DateCovid;
use App\Models\Judet;
use App\Models\DateCovidJudet;

class CazuriNoiJudeteController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $date_covid = DateCovid::get_last_inserted();
        $date_covid_1_week = DateCovid::DateCovidLastWeek()->get();
        //$date_covid_judete_7_zile = DateCovidJudet::getCazuriNoiJudeteLastWeek()->unique('id_judet');
        $date_covid_judete_7_zile = Judet::getCazuriNoiJudeteLastWeek();
        //dd($date_covid_judete_7_zile);

        return view('cazuri_noi_judete', ['date_covid' => $date_covid,  'date_covid_1_week' => $date_covid_1_week, 'date_covid_judete_7_zile' => $date_covid_judete_7_zile]);
    }
}