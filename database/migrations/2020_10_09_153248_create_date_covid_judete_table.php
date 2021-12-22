<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateCovidJudeteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_covid_judete_table', function (Blueprint $table) {
            $table->id();
            $table->integer('id_judet')->unsigned();
            $table->date('data');
            $table->integer('cazuri_totale')->unsigned();
            $table->integer('modificare');
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
        Schema::dropIfExists('date_covid_judete_table');
    }
}
