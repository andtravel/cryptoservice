<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function chartData(User $user)
    {
        $currencies = $user->currencies()->get();
        $data = [];
        foreach ($currencies as $currency) {
            $amounts = DB::table('currency_history')
                ->select('amount')
                ->orderBy('created_at', 'desc')
                ->limit(12)
                ->where('currency_id', $currency->id)
                ->get();

            $dataCol = array_reverse($amounts->pluck('amount')->map(fn($item) => floatval($item))->all());
            $data += [$currency->name => $dataCol];
        }

        return response()->json($data);
    }
}
