<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\DisorderType;
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
                'mental_disorder_count' => 0,
                'physical_disorder_count' => 0,
                'smoker_count' => 0,
                'drinks_alcohol_count' => 0,
                'physical_activity_count' => 0,
                'has_medical_history_count' => 0,
                'has_allergies_count' => 0,
            ];
        }

        $smokerCount = 0;
        $drinksAlcoholCount = 0;
        $physicalActivityCount = 0;
        $hasMedicalHistoryCount = 0;
        $hasAllergiesCount = 0;
        $mentalDisorderCount = 0;
        $physicalDisorderCount = 0;

        foreach ($diagnoses as $diagnosis) {
            if (false === $this->validateDiagnosis($diagnosis)) {
                continue;
            }

            // Count based on disorder type
            if ($diagnosis['disorder_type'] === DisorderType::MENTAL) {
                $mentalDisorderCount++;
            } elseif ($diagnosis['disorder_type'] === DisorderType::PHYSICAL) {
                $physicalDisorderCount++;
            }

            // Count other stats
            if ($diagnosis['smoker']) {
                $smokerCount++;
            }
            if ($diagnosis['drinks_alcohol']) {
                $drinksAlcoholCount++;
            }
            if ($diagnosis['physical_activity']) {
                $physicalActivityCount++;
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
            'mental_disorder_count' => $mentalDisorderCount > 0 ? round(($mentalDisorderCount / $totalDiagnoses) * 100) : 0,
            'physical_disorder_count' => $physicalDisorderCount > 0 ? round(($physicalDisorderCount / $totalDiagnoses) * 100) : 0,
            'smoker_count' => $smokerCount > 0 ? round(($smokerCount / $totalDiagnoses) * 100) : 0,
            'drinks_alcohol_count' => $drinksAlcoholCount > 0 ? round(($drinksAlcoholCount / $totalDiagnoses) * 100) : 0,
            'physical_activity_count' => $physicalActivityCount > 0 ? round(($physicalActivityCount / $totalDiagnoses) * 100) : 0,
            'has_medical_history_count' => $hasMedicalHistoryCount > 0 ? round(($hasMedicalHistoryCount / $totalDiagnoses) * 100) : 0,
            'has_allergies_count' => $hasAllergiesCount > 0 ? round(($hasAllergiesCount / $totalDiagnoses) * 100) : 0,
        ];
    }

    private function validateDiagnosis(array $diagnosis): bool
    {
        $requiredKeys = [
            'disorder_type' => null,
            'has_medical_history' => null,
            'physical_activity' => null,
            'smoker' => null,
            'drinks_alcohol' => null,
            'has_allergies' => null,
        ];

        return \count(\array_intersect_key($requiredKeys, $diagnosis)) === \count($requiredKeys);
    }
}
