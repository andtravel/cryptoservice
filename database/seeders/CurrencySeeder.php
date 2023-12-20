<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crypto = ['BTC', 'XRP', 'ETH', 'LTC', 'XMR'];

        for ($i = 0; $i < count($crypto); $i++) {
            DB::table('currencies')->insert([
                'name' => $crypto[$i]
            ]);
        }

    }
}
