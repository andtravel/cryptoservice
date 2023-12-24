<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
        $chartKeys = array_keys(json_decode($this->transit(), JSON_OBJECT_AS_ARRAY));

        return view('home', compact('chartKeys'));
    }

    public function chartData()
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
            $dataCol = $collection->map(function ($item, $key) {
                return floatval($item);
            })->all();

            $data += [$currency->name => $dataCol];
        }

        return response()->json($data);
    }

    public function transit()
    {
        return $this->chartData()->content();
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
