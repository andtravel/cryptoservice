<?php

use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/choice', [App\Http\Controllers\HomeController::class, 'choosePage'])->name('page');
Route::post('/choice', [App\Http\Controllers\HomeController::class, 'chooseCrypto'])->name('cryptos');
Route::get('/chart', [ChartController::class, 'index']);
Route::get('/chart/data', [ChartController::class, 'chartData']);
