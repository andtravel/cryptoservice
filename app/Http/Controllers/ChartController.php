<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public object $home;

    public function __construct(HomeController $home)
    {
        $this->home = $home;
    }

    public function chartData()
    {
        return $this->home->chartData();
    }
}
