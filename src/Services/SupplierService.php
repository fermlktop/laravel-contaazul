<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class SupplierService
{
    public function create(array $data): object
    {
        $response = Http::contaAzul()->post("/v1/suppliers", $data);

        return $response->json();
    }

    public function byId(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/suppliers/$id");

        return $response->json();
    }

    public function delete(string $id): object
    {
        $response = Http::contaAzul()->delete("/v1/suppliers/$id");

        return $response->json();
    }

    public function update(string $id, array $data): object
    {
        $response = Http::contaAzul()->put("/v1/suppliers/$id", $data);

        return $response->json();
    }

    public function get(array $filters=[]): object
    {
        $response = Http::contaAzul()->delete("/v1/suppliers", $filters);

        return $response->json();
    }
}
