<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class ContractService
{
    public function createContract(array $data): object
    {
        $response = Http::contaAzul()->post("/v1/contracts", $data);

        return $response->json();
    }

    public function getContractById(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/contracts/$id");

        return $response->json();
    }
}
