<?php

declare(strict_types=1);

namespace App\Dto;

class DiagnosisDTO
{

    public function __construct(
        private bool   $hasDisorderType,
        private string $disorderType,
        private string $medicalHistory,
        private string $physicalActivity,
        private bool   $smoker,
        private bool   $drinksAlcohol,
        private bool   $hasAllergies
    ) {}

}
