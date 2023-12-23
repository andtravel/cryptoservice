<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {

        return view('chart');
    }

    public function chartData()
    {
        $data = [43802.40, 43802.10, 43780.80, 43823.83, 43830.24, 43834.88, 43846.30, 43847.09, 43802.40, 43802.10, 43780.80, 43823.83];

        /*$data = [strtotime("2023-12-23 01:34:37") => "43802.40",
            strtotime("2023-12-23 01:34:47") => "43802.10",
            strtotime("2023-12-23 01:34:57") => "43780.80",
            strtotime("2023-12-23 01:46:14") => "43823.83",
            strtotime("2023-12-23 01:46:24") => "43830.24",
            strtotime("2023-12-23 01:46:34") => "43834.88",
            strtotime("2023-12-23 01:46:44") => "43846.30",
            strtotime("2023-12-23 01:46:54") => "43847.09"];*/
        return response()->json($data);
    }
}
