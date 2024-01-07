<?php

namespace App\Http\Controllers;

use App\Models\Currency;
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
        $currencies = auth()->user()->currencies()->get();

        $data = [];
        foreach ($currencies as $currency) {
            $amounts = DB::table('currency_history')
                ->select('amount')
                ->limit(24)
                ->where('currency_id', $currency->id)
                ->get();

            $collection = $amounts->pluck('amount');
            $dataCol = $collection->map(function ($item) {
                return floatval($item);
            })->all();

            $data += [$currency->name => $dataCol];
        }

        return to_route('home');
    }
}
