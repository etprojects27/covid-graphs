<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\DateCovid;

class DeceseNoiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $date_covid = DateCovid::get_last_inserted();
        $date_covid_1_week = DateCovid::DateCovidLastWeek()->get();
        
        return view('decese_noi', ['date_covid' => $date_covid,  'date_covid_1_week' => $date_covid_1_week]);
    }
}