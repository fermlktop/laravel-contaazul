<?php

namespace EliseuSantos\ContaAzul\Tests\Unit;

use EliseuSantos\ContaAzul\Services\PlanService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use EliseuSantos\ContaAzul\Tests\TestCase;

class PlanServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::macro('contaAzul', null);
    }

    public function testGetCurrentPlan()
    {
        $planService = new PlanService();

        Http::fake([
            '*/v1/plans' => Http::response(['id' => '123', 'name' => 'Basic Plan'], 200)
        ]);

        $response = $planService->getCurrentPlan();

        $this->assertEquals('123', $response['id']);
        $this->assertEquals('Basic Plan', $response['name']);
    }
}
