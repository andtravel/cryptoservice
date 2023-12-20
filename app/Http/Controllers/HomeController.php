<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

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
        $cryptos = Currency::all();

        return view('home', compact('cryptos'));
    }

    public function choose(Request $request)
    {
        $currencies = array_keys($request->all(), 'on');

        foreach ($currencies as $currency) {
            auth()->user()->currencies()->attach($currency);
        }
        return back();
    }
}
