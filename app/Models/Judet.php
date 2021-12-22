<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DateCovidJudet;
use Illuminate\Support\Facades\DB;


class Judet extends Model
{
    protected $table = 'judete_table';
    protected $primaryKey = 'id';
    
    public function date_covid_judet()
    {
        return $this->hasMany(DateCovidJudet::class,'id_judet');
    }

    public static function getCazuriNoiJudeteLastWeek(){
        /* data ultimei inregistrari introduse in tabel */
        $last_date = DateCovidJudet::latest('data')->first()->data;

         /* subquery 1 - total cazuri noi covid, grupate pe judete, in ultimele 7 zile */
        $data_7 = new \DateTime($last_date);
        date_sub($data_7, date_interval_create_from_date_string("7 days"));

        $judete = DB::table('judete_table')
                   ->leftJoin('date_covid_judete_table', 'judete_table.id','=', 'date_covid_judete_table.id_judet')
                   ->select(
                       'judete_table.id as id_judet',
                       'judete_table.denumire',
                       DB::raw('GROUP_CONCAT(date_covid_judete_table.modificare) as modificare_covid_7_zile'),
                       DB::raw('GROUP_CONCAT(date_covid_judete_table.data) as date_covid_7_zile')
                   )
                   ->where('date_covid_judete_table.data', '>=', $data_7)
                   ->groupBy('id_judet')
                   ->get();

        return $judete;
}

    public static function getCazuriTotaleJudeteLastWeek() {
    /* data ultimei inregistrari introduse in tabel */
    $last_date = DateCovidJudet::latest('data')->first()->data;

    /* subquery 1 - total cazuri noi covid, grupate pe judete, in ultimele 7 zile */
    $data_7 = new \DateTime($last_date);
    date_sub($data_7, date_interval_create_from_date_string("7 days"));

    $judete = DB::table('judete_table')
                ->leftJoin('date_covid_judete_table', 'judete_table.id','=', 'date_covid_judete_table.id_judet')
                ->select(
                    'judete_table.id as id_judet',
                    'judete_table.denumire',
                    'judete_table.populatie',
                    DB::raw('GROUP_CONCAT(date_covid_judete_table.cazuri_totale) as cazuri_totale_covid_7_zile'),
                    DB::raw('GROUP_CONCAT(date_covid_judete_table.data) as date_covid_7_zile')
                )
                ->where('date_covid_judete_table.data', '>=', $data_7)
                ->groupBy('id_judet')
                ->get();

   return $judete;
}

}
