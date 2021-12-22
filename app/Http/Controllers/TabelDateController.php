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

class TabelDateController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $date_covid = DateCovid::get_last_inserted();
        // $date_covid_judete = DateCovidJudet::get_date_covid_judete();
        $date_covid_table = DateCovid::get_date_covid();

        return view('tabel_date', ['date_covid' => $date_covid, 'date_covid_table' => $date_covid_table]);

    }
    
}