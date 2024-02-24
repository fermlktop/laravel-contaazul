<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class ServicesService
{
    public function createService(array $data): object
    {
        $response = Http::contaAzul()->post("/v1/services", $data);

        return $response->json();
    }

    public function getServices(array $filters): object
    {
        $response = Http::contaAzul()->get("/v1/services");

        return $response->json();
    }

    public function getServiceById(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/services/$id");

        return $response->json();
    }

    public function updateServiceById(string $id, array $data): object
    {
        $response = Http::contaAzul()->put("/v1/services/$id", $data);

        return $response->json();
    }
}
