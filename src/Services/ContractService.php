<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class ContractService
{
    public function create(array $data): array
    {
        $response = Http::contaAzul()->post("/v1/contracts", $data);

        return $response->json();
    }

    public function byId(string $id): array
    {
        $response = Http::contaAzul()->get("/v1/contracts/$id");

        return $response->json();
    }
}
