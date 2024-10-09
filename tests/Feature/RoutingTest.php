<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_200_for_each_get_route(): void
    {
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertViewIs('app');

        $allDiagnosesResponse = $this->get('/diagnosis/all');
        $allDiagnosesResponse->assertStatus(200);
        $allDiagnosesResponse->assertJsonIsArray();

        $diagnosesStatisticsResponse = $this->get('/diagnosis/statistics');
        $diagnosesStatisticsResponse->assertStatus(200);
        $allDiagnosesResponse->assertJsonIsArray();
        $diagnosesStatisticsResponse->assertJsonCount(5);
    }
}
