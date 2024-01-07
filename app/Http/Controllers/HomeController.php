<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ChartController;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chartData = $this->chartData()->getOriginalContent();

        return view('home', compact('chartData'));
    }

    public function chartData()
    {
        $user = auth()->guard()->user();

        $chart = new ChartController();

        return $chart->chartData($user);
    }
    public function choosePage()
    {
        $cryptos = Currency::all();

        return view('choiceCrypto', compact('cryptos'));
    }

    public function chooseCrypto(Request $request)
    {
        $currencies = array_keys($request->all(), 'on');

        foreach ($currencies as $currency) {
            auth()->user()->currencies()->attach($currency);
        }
        return to_route('home');
    }

}
