<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class SupplierService
{
    public function createSupplier(array $data): object
    {
        $response = Http::contaAzul()->post("/v1/suppliers", $data);

        return $response->json();
    }

    public function getSupplierById(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/suppliers/$id");

        return $response->json();
    }

    public function deleteSupplierById(string $id): object
    {
        $response = Http::contaAzul()->delete("/v1/suppliers/$id");

        return $response->json();
    }

    public function updateSupplierById(string $id, array $data): object
    {
        $response = Http::contaAzul()->put("/v1/suppliers/$id", $data);

        return $response->json();
    }

     public function getSuppliers(array $filters): object
    {
        $response = Http::contaAzul()->delete("/v1/suppliers", $filters);

        return $response->json();
    }
}
