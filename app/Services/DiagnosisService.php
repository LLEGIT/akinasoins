<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\DiagnosisRepository;

readonly class DiagnosisService
{

    public function __construct(
        private DiagnosisRepository $diagnosisRepository,
    )
    {
    }

    public function create(array $diagnosis): bool
    {
        if (false === $this->validateDiagnosis($diagnosis)) {
            return false;
        }

        return $this->diagnosisRepository->createDiagnosis($diagnosis);
    }

    public function getAll(): array
    {
        return $this->diagnosisRepository->getAllDiagnoses();
    }

    public function getStatistics(): array
    {
        $diagnoses = $this->diagnosisRepository->getAllDiagnoses();

        if ([] === $diagnoses) {
            return [
                'smokerCount' => 0,
                'drinksAlcoholCount' => 0,
                'hasDisorderCount' => 0,
                'hasMedicalHistoryCount' => 0,
                'hasAllergiesCount' => 0,
            ];
        }

        $smokerCount = 0;
        $drinksAlcoholCount = 0;
        $hasDisorderCount = 0;
        $hasMedicalHistoryCount = 0;
        $hasAllergiesCount = 0;

        foreach ($diagnoses as $diagnosis) {
            if (false === $this->validateDiagnosis($diagnosis)) {
                continue;
            }

            if ($diagnosis['smoker']) {
                $smokerCount++;
            }
            if ($diagnosis['drinks_alcohol']) {
                $drinksAlcoholCount++;
            }
            if ($diagnosis['has_disorder_type']) {
                $hasDisorderCount++;
            }
            if ($diagnosis['has_medical_history']) {
                $hasMedicalHistoryCount++;
            }
            if ($diagnosis['has_allergies']) {
                $hasAllergiesCount++;
            }
        }

        $totalDiagnoses = \count($diagnoses);

        return [
            'smokerCount' => $smokerCount > 0 ? round(($smokerCount / $totalDiagnoses) * 100) : 0,
            'drinksAlcoholCount' => $drinksAlcoholCount > 0 ? round(($drinksAlcoholCount / $totalDiagnoses) * 100) : 0,
            'hasDisorderCount' => $hasDisorderCount > 0 ? round(($hasDisorderCount / $totalDiagnoses) * 100) : 0,
            'hasMedicalHistoryCount' => $hasMedicalHistoryCount > 0 ? round(($hasMedicalHistoryCount / $totalDiagnoses) * 100) : 0,
            'hasAllergiesCount' => $hasAllergiesCount > 0 ? round(($hasAllergiesCount / $totalDiagnoses) * 100) : 0,
        ];
    }

    private function validateDiagnosis(array $diagnosis): bool
    {
        $requiredKeys = [
            'has_disorder_type' => null,
            'has_medical_history' => null,
            'physical_activity' => null,
            'smoker' => null,
            'drinks_alcohol' => null,
            'has_allergies' => null,
        ];

        return \count(\array_intersect_key($requiredKeys, $diagnosis)) === \count($requiredKeys);
    }
}
