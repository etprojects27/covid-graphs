<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Judet;
use Illuminate\Support\Facades\DB;
use App\Models\DateTime;

class DateCovidJudet extends Model
{
    protected $table = 'date_covid_judete_table';
    protected $primaryKey = 'id';

    public static function getDateJudeteLastDate(){
        /* data ultimei inregistrari introduse in tabel */
        $last_date = self::latest('data')->first()->data;

        /* subquery 1 - total cazuri covid, grupate pe judete, cu o zi inainte */
        $data_1 = new \DateTime($last_date);
        date_sub($data_1, date_interval_create_from_date_string("1 days"));
        
        // $nr_cazuri_yesterday = self::select('id_judet', 'cazuri_totale as cazuri_totale_yesterday')
        //               ->where('data', '=', $data_1);

        /* subquery 1 - total cazuri noi covid, grupate pe judete, in ultimele 7 zile */
        $data_3 = new \DateTime($last_date);
        date_sub($data_3, date_interval_create_from_date_string("3 days"));

        $nr_cazuri_last_3_days = self::select('id_judet', DB::raw('SUM(modificare) as nr_total_cazuri_3'))
                   ->where('data', '>=', $data_3)
                   ->groupBy('id_judet');

         /* subquery 2 - total cazuri noi covid, grupate pe judete, in ultimele 7 zile */
        $data_7 = new \DateTime($last_date);
        date_sub($data_7, date_interval_create_from_date_string("7 days"));

        $nr_cazuri_last_7_days = self::select('id_judet', DB::raw('SUM(modificare) as nr_total_cazuri_7'))
                   ->where('data', '>=', $data_7)
                   ->groupBy('id_judet');
 

        /* subquery 3 - total cazuri noi covid, grupate pe judete, in ultimele 14 zile */
        $data_14 = new \DateTime($last_date);
        date_sub($data_14, date_interval_create_from_date_string("14 days"));

        $nr_cazuri_last_14_days = self::select('id_judet', DB::raw('SUM(modificare) as nr_total_cazuri_14'))
                    ->where('data', '>=', $data_14)
                    ->groupBy('id_judet');


        /* query + subquery - date covid preluate din tabelul date_covid_judete_table + subquery 1 + subquery 2 + subquery3 + relatia judet */
        $judete = self::joinSub($nr_cazuri_last_7_days, 'date_covid_judete_table_7_zile', function ($join) {
            $join->on('date_covid_judete_table.id_judet', '=', 'date_covid_judete_table_7_zile.id_judet');
        })
        ->joinSub($nr_cazuri_last_14_days, 'date_covid_judete_table_14_zile', function ($join) {
            $join->on('date_covid_judete_table.id_judet', '=', 'date_covid_judete_table_14_zile.id_judet');
        })
        ->joinSub($nr_cazuri_last_3_days, 'date_covid_judete_table_3_zile', function ($join) {
            $join->on('date_covid_judete_table.id_judet', '=', 'date_covid_judete_table_3_zile.id_judet');
        })
        // ->joinSub($nr_cazuri_yesterday, 'date_covid_judete_table_yesterday', function ($join) {
        //      $join->on('date_covid_judete_table.id_judet', '=', 'date_covid_judete_table_yesterday.id_judet');
        // })
        ->with('judet')
        //->where('data','=', $last_date)
        ->limit(2100)
        ->get();

        return $judete;
    }

    public function scopeJudeteLastDate($query)
    {
        $last_date = self::latest('data')->first()->data;
        return $query->where('data', '=', $last_date);
    }

    public function scopePrahova($query)
    {
        return $query->where('id_judet', '=', 32);
    }

    public function scopeJudeteLastWeek($query)
    {
        $last_date = self::latest('data')->first()->data;
        $data = new \DateTime($last_date);
        date_sub($data, date_interval_create_from_date_string("7 days"));
        
        return $query->where('data', '>=', $data);
    }

    public function scopeJudeteLast2Weeks($query)
    {
        $last_date = self::latest('data')->first()->data;
        $data = new \DateTime($last_date);
        date_sub($data, date_interval_create_from_date_string("14 days"));
    
        return $query->where('data', '>=', $data);
    }

    public function judet()
    {
        return $this->belongsTo(Judet::class, 'id_judet', 'id');
    }

    public static function getDateCovidByJudet() {
        $date = self::leftJoin('judete_table', 'judete_table.id', '=', 'date_covid_judete_table.id_judet')
        ->select('id_judet', DB::raw('SUM(modificare) as nr_total_cazuri_14'))
        ->groupBy('id_judet')
        ->limit(2100)
        ->get();

        return $date;
    }

}