<?php

namespace App\Repositories;

use App\Models\Diagnosis;

class DiagnosisRepository
{
    public function createDiagnosis(array $diagnosis): bool
    {
        $model = new Diagnosis($diagnosis);
        return $model->save();
    }

    public function getAllDiagnoses(): array
    {
        return Diagnosis::all()->toArray();
    }

}
