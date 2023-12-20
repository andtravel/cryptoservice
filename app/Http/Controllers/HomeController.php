<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use GuzzleHttp\Client;
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
        $cryptos = Currency::all();

        return view('home', compact('cryptos'));
    }

    public function choose(Request $request)
    {
        $currencies = array_keys($request->all(), 'on');

        foreach ($currencies as $currency) {
            auth()->user()->currencies()->attach($currency);
        }
        return redirect()->back();
    }

    public function test()
    {
        $user = auth()->user()->getAuthIdentifier();

        $client = new Client(['base_uri' => 'https://api.coinbase.com']);

        $response = $client->get('/v2/prices/BTC-USD/buy');

       $data = (json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY))['data'];

       $crypto = DB::table('currency_user')->where('user_id', $user)->first();


        DB::table('currency_history')->insert([
            'currency_id' => $crypto->currency_id,
            'amount' => $data['amount'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
