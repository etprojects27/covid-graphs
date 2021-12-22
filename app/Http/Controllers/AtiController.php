<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use App\Models\DateCovid;

class AtiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $date_covid = DateCovid::get_last_inserted();
        $date_covid_1_week = DateCovid::DateCovidLastWeek()->get();

        return view('ati', ['date_covid' => $date_covid, 'date_covid_1_week' => $date_covid_1_week]);
    }
}
