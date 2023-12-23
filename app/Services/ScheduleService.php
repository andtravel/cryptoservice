<?php

namespace App\Services;

use App\Models\Currency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class ScheduleService
{
    public function hourlyCron()
    {
        try {
            $client = new Client(['base_uri' => 'https://api.coinbase.com']);

            $currencies = Currency::all();

            foreach ($currencies as $currency) {
                $response = $client->get('/v2/prices/' . $currency->name . '-USD/buy');
                $data = (json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY))['data'];

                DB::table('currency_history')->insert([
                    'currency_id' => $currency->id,
                    'amount' => $data['amount'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        } catch (\Exception $e) {
            $e = 'Error data';
        }
    }
}
