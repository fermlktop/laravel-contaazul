<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class PlanService
{
    public function getCurrentPlan(): object
    {
        $response = Http::contaAzul()->get("/v1/plans");

        return $response->json();
    }
}
