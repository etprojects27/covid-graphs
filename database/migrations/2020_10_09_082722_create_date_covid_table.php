<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateCovidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_covid_table', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->integer('nr_total_cazuri');
            $table->integer('nr_cazuri_noi');
            $table->integer('nr_cazuri_reconfirmate');
            $table->integer('nr_total_teste');
            $table->integer('nr_teste_noi');
            $table->integer('nr_total_decese');
            $table->integer('nr_decese_noi');
            $table->integer('nr_total_recuperati');
            $table->integer('nr_recuperati_noi');
            $table->integer('nr_total_activi_ati');
            $table->integer('nr_teste_definitie_caz');
            $table->integer('nr_teste_cerere');
            $table->integer('nr_izolare_domiciliu');
            $table->integer('nr_izolare_inst');
            $table->integer('nr_carantina_domiciliu');
            $table->integer('nr_carantina_inst');
            $table->integer('nr_apeluri_urgenta');
            $table->integer('nr_apeluri_informare');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('date_covid_table');
    }
}
