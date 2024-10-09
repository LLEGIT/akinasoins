<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(DiagnosisTableSeeder::class);

        $this->command->info('Diagnosis table seeded !');
    }

}
