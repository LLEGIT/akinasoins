<?php

namespace App\Http\Controllers;

use App\Services\DiagnosisService;

class StatisticsController extends Controller {

protected $diagnosisService;

    public function __construct(DiagnosisService $diagnosisService)
    {
        $this->diagnosisService = $diagnosisService;
    }


    public function index()
    {

        $pourcent = $this->diagnosisService->getStatistics();


        return view('statistics', compact('pourcent'));
    }
}