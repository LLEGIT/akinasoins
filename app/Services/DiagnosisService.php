<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\DiagnosisRepository;

readonly class DiagnosisService
{

    public function __construct(
        private DiagnosisRepository $diagnosisRepository,
    ) {}

    public function create(array $diagnosis): bool
    {
        if (false ===$this->validateDiagnosis($diagnosis)) {
            return false;
        }

        return $this->diagnosisRepository->createDiagnosis($diagnosis);
    }

    public function getAll(): array
    {
        return $this->diagnosisRepository->getAllDiagnoses();
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
