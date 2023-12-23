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
        $currencies = auth()->user()->currencies()->get();

        foreach ($currencies as $currency) {
            $amounts = DB::table('currency_history')->select('amount', 'created_at')->where('currency_id', $currency->id)->get();
            $collection = collect($amounts);
            $d = $collection->value($amounts);
//            dd(Collection::unwrap($d));
            dd($amounts);
        }

        return view('home');
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
