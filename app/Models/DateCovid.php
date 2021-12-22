<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DateCovid extends Model
{
    protected $table = 'date_covid_table';
    protected $primaryKey = 'id';

    public static function get_last_inserted() {
        $date_covid = self::latest('data')->first();

        return $date_covid;
    }

    public static function get_date_covid() {
        $date_covid = self::select('*')->limit(2100)->orderBy('data','asc')->get();

        return $date_covid;
    }

    public static function get_date_covid_work_in_progess() {
        //$date_covid = self::select('*')->limit(2100)->orderBy('data','desc')->get();

        /* data ultimei inregistrari introduse in tabel */
        $last_date = self::latest('data')->first()->data;

        /* subquery 1 - total cazuri covid, grupate pe judete, cu o zi inainte */
        $data_1 = new \DateTime($last_date);
        date_sub($data_1, date_interval_create_from_date_string("1 days"));
        
        $date_covid_yesterday = self::select('id', 'nr_cazuri_noi as nr_cazuri_noi_yesterday')
                        ->where('data', '=', $data_1);

         /* query + subquery - date covid preluate din tabelul date_covid_judete_table + subquery 1 */
         $date_covid = self::select('*')
         ->joinSub($date_covid_yesterday, 'date_covid_yesterday_table', function ($leftjoin) {
            $leftjoin->on('date_covid_table.id', '=', 'date_covid_yesterday_table.id');
        })
        ->limit(2100)
        ->get();

        return $date_covid;
    }
    public function scopeDateCovidLastWeek($query)
    {
        $last_date = self::latest('data')->first()->data;
        $data = new \DateTime($last_date);
        date_sub($data, date_interval_create_from_date_string("7 days"));
        
        return $query->where('data', '>=', $data);
    }

    public function scopeDateCovidLast2Weeks($query)
    {
        $last_date = self::latest('data')->first()->data;
        $data = new \DateTime($last_date);
        date_sub($data, date_interval_create_from_date_string("14 days"));
    
        return $query->where('data', '>=', $data);
    }
}