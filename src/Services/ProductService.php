<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class ProductService
{
    public function create(array $data): array
    {
        $response = Http::contaAzul()->post("/v1/products", $data);

        return $response->json();
    }

    public function get($filters=[]): array
    {
        $response = Http::contaAzul()->get("/v1/products");

        return $response->json();
    }

    public function categoryById(string $id): array
    {
        $response = Http::contaAzul()->get("/v1/product-categories/$id");

        return $response->json();
    }

    public function categories($filters=[]): array
    {
        $response = Http::contaAzul()->get("/v1/product-categories");

        return $response->json();
    }

    public function byId(string $id): array
    {
        $response = Http::contaAzul()->get("/v1/products/$id");

        return $response->json();
    }

    public function update(string $id, array $data): array
    {
        $response = Http::contaAzul()->put("/v1/products/$id", $data);

        return $response->json();
    }

    public function delete(string $id): array
    {
        $response = Http::contaAzul()->delete("/v1/products/$id");

        return $response->json();
    }
}
