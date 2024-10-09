<?php

namespace App\Http\Controllers;

class StatisticsController extends Controller
{
    public function index()
    {
        $pourcentage = [
            'antecedent' => '30',
            'fumeur' => '40',
            'consulteGeneraliste' => '50',
            'troubleMental' => '60'
        ];
        return view('statistics', compact('pourcentage'));
    }
}