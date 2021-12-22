<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CazuriNoiController;
use App\Http\Controllers\TesteNoiController;
use App\Http\Controllers\RataReproductieController;
use App\Http\Controllers\TotalCazuriController;
use App\Http\Controllers\TabelJudeteController;
use App\Http\Controllers\TabelDateController;
use App\Http\Controllers\AtiController;
use App\Http\Controllers\DeceseNoiController;
use App\Http\Controllers\TotalRecuperatiController;
use App\Http\Controllers\TotalTesteController;
use App\Http\Controllers\TotalDeceseController;
use App\Http\Controllers\CarantinaController;
use App\Http\Controllers\ProcentInfectareController;
use App\Http\Controllers\CazuriNoiJudeteController;
use App\Http\Controllers\CazuriTotaleJudeteController;
use App\Http\Controllers\ProcentInfectareJudeteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

\DB::listen(function($sql) {
    \Log::info($sql->sql);
    \Log::info($sql->bindings);
    \Log::info($sql->time);
});


// Route::get('/', function () {
//     return view('dashboard', ['page' => 'tabel_judete']);
// });

/* Cazuri noi */
Route::get('/', [DashboardController::class, 'index']);

Route::get('/cazuri-noi', [CazuriNoiController::class, 'index'])->name('cazuri_noi.view');

Route::get('/teste-noi', [TesteNoiController::class, 'index'])->name('teste_noi.view');

Route::get('/procent-infectare', [ProcentInfectareController::class, 'index'])->name('procent_infectare.view');

Route::get('/ati', [AtiController::class, 'index'])->name('ati.view');

Route::get('/decese-noi', [DeceseNoiController::class, 'index'])->name('decese_noi.view');

// Route::get('/rata-reproductie', [RataReproductieController::class, 'index'])->name('rata_reproductie.view');

Route::get('/total-cazuri', [TotalCazuriController::class, 'index'])->name('total_cazuri.view');

Route::get('/carantina', [CarantinaController::class, 'index'])->name('carantina.view');

Route::get('/total-teste', [TotalTesteController::class, 'index'])->name('total_teste.view');

Route::get('/total-recuperati', [TotalRecuperatiController::class, 'index'])->name('total_recuperati.view');

Route::get('/total-decese', [TotalDeceseController::class, 'index'])->name('total_decese.view');

Route::get('/cazuri-noi-judete', [CazuriNoiJudeteController::class, 'index'])->name('cazuri_noi_judete.view');

Route::get('/cazuri-totale-judete', [CazuriTotaleJudeteController::class, 'index'])->name('cazuri_totale_judete.view');

Route::get('/procent-infectare-judete', [ProcentInfectareJudeteController::class, 'index'])->name('procent_infectare_judete.view');

Route::get('/tabel-judete', [TabelJudeteController::class, 'index'])->name('tabel_judete.view');

Route::get('/tabel-date', [TabelDateController::class, 'index'])->name('tabel_date.view');



