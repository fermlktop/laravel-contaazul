<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class PlanService
{
    public function current(): array
    {
        $response = Http::contaAzul()->get("/v1/plans");

        return $response->json();
    }
}
