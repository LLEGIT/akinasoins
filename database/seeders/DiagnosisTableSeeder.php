<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Diagnosis;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiagnosisTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('diagnoses')->delete();

        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Diagnosis::create([
                'has_disorder_type'   => $faker->boolean(50),
                'has_medical_history' => $faker->boolean(70),
                'physical_activity'   => $faker->boolean(70),
                'smoker'              => $faker->boolean(30),
                'drinks_alcohol'      => $faker->boolean(40),
                'has_allergies'       => $faker->boolean(60),
            ]);
        }
    }
}
