<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class ProductService
{
    public function create(array $data): object
    {
        $response = Http::contaAzul()->post("/v1/products", $data);

        return $response->json();
    }

    public function get($filters=[]): object
    {
        $response = Http::contaAzul()->get("/v1/products");

        return $response->json();
    }

    public function categoryById(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/product-categories/$id");

        return $response->json();
    }

    public function categories($filters=[]): object
    {
        $response = Http::contaAzul()->get("/v1/product-categories");

        return $response->json();
    }

    public function byId(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/products/$id");

        return $response->json();
    }

    public function update(string $id, array $data): object
    {
        $response = Http::contaAzul()->put("/v1/products/$id", $data);

        return $response->json();
    }

    public function delete(string $id): object
    {
        $response = Http::contaAzul()->delete("/v1/products/$id");

        return $response->json();
    }
}
