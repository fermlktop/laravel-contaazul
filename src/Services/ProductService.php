<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class ProductService
{
    public function createProduct(array $data): object
    {
        $response = Http::contaAzul()->post("/v1/products", $data);

        return $response->json();
    }

    public function getProducts(): object
    {
        $response = Http::contaAzul()->get("/v1/products");

        return $response->json();
    }

    public function getCategory(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/product-categories/$id");

        return $response->json();
    }

    public function getCategories(): object
    {
        $response = Http::contaAzul()->get("/v1/product-categories");

        return $response->json();
    }

    public function getProductById(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/products/$id");

        return $response->json();
    }

    public function updateProductById(string $id, array $data): object
    {
        $response = Http::contaAzul()->put("/v1/products/$id", $data);

        return $response->json();
    }

    public function deleteProductById(string $id): object
    {
        $response = Http::contaAzul()->delete("/v1/products/$id");

        return $response->json();
    }
}
