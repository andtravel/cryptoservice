<?php

<<<<<<< HEAD
use App\Http\Controllers\ChartController;
use App\Http\Controllers\HomeController;
=======
use App\Http\Controllers\HomeController;
use App\Models\User;
>>>>>>> feature_mail_service
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


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/choice', [HomeController::class, 'choosePage'])->name('page');
Route::post('/choice', [HomeController::class, 'chooseCrypto'])->name('cryptos');
<<<<<<< HEAD
Route::get('/chart/data', [ChartController::class, 'chartData']);
=======
Route::get('/chart/data', [HomeController::class, 'chartData'])->name('chartData');
Route::get('/mail/{id}', function ($id) {
            $user = User::findOrFail($id);
    return new App\Mail\Mailing($user);
});
>>>>>>> feature_mail_service
