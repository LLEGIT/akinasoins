<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Repositories\DiagnosisRepository;
use App\Services\DiagnosisService;
use PHPUnit\Framework\TestCase;

class DiagnosisServiceTest extends TestCase
{
    public function test_that_empty_diagnoses_returns_0_statistics(): void
    {
        $diagnosisRepository = $this->createMock(DiagnosisRepository::class);
        $diagnosisRepository->method('getAllDiagnoses')->willReturn([]);

        $diagnosisService = new DiagnosisService($diagnosisRepository);

        $this->assertEquals(
            [
                'smoker_count' => 0,
                'drinks_alcohol_count' => 0,
                'physical_activity_count' => 0,
                'has_disorder_count' => 0,
                'has_medical_history_count' => 0,
                'has_allergies_count' => 0,
            ],
            $diagnosisService->getStatistics(),
        );
    }

    public function test_that_diagnoses_returns_correct_statistics(): void
    {
        $diagnoses = [
            [
                'smoker' => true,
                'physical_activity' => true,
                'drinks_alcohol' => true,
                'has_disorder_type' => false,
                'has_medical_history' => true,
                'has_allergies' => false,
            ],
            [
                'smoker' => false,
                'physical_activity' => true,
                'drinks_alcohol' => false,
                'has_disorder_type' => true,
                'has_medical_history' => false,
                'has_allergies' => true,
            ],
            [
                'smoker' => true,
                'physical_activity' => true,
                'drinks_alcohol' => false,
                'has_disorder_type' => true,
                'has_medical_history' => true,
                'has_allergies' => true,
            ],
        ];

        $diagnosisRepository = $this->createMock(DiagnosisRepository::class);
        $diagnosisRepository->method('getAllDiagnoses')->willReturn($diagnoses);

        $diagnosisService = new DiagnosisService($diagnosisRepository);

        $expectedStatistics = [
            'smoker_count' => round(2 / 3 * 100),
            'drinks_alcohol_count' => round(1 / 3 * 100),
            'physical_activity_count' => 100,
            'has_disorder_count' => round(2 / 3 * 100),
            'has_medical_history_count' => round(2 / 3 * 100),
            'has_allergies_count' => round(2 / 3 * 100),
        ];

        $this->assertEquals($expectedStatistics, $diagnosisService->getStatistics());
    }
}
