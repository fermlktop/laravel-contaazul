<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class ServicesService
{
    public function create(array $data): object
    {
        $response = Http::contaAzul()->post("/v1/services", $data);

        return $response->json();
    }

    public function get(array $filters): object
    {
        $response = Http::contaAzul()->get("/v1/services");

        return $response->json();
    }

    public function byId(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/services/$id");

        return $response->json();
    }

    public function update(string $id, array $data): object
    {
        $response = Http::contaAzul()->put("/v1/services/$id", $data);

        return $response->json();
    }
}
