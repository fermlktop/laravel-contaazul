<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class CustomerService
{
    public function create(array $data): object
    {
        $response = Http::contaAzul()->post("/v1/customers", $data);

        return $response->json();
    }

    public function get($filters=[]): array
    {
        $response = Http::contaAzul()->get('/v1/customers');

        return $response->json();
    }

    public function contacts(string $id, array $filters): array
    {
        $response = Http::contaAzul()->get("/v1/customers/$id/contacts", $filters);

        return $response->json();
    }

    public function byId(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/customers/$id");

        return $response->json();
    }

    public function update(string $id, array $data): object
    {
        $response = Http::contaAzul()->put("/v1/customers/$id", $data);

        return $response->json();
    }

    public function delete(string $id): object
    {
        $response = Http::contaAzul()->delete("/v1/customers/$id");

        return $response->json();
    }

    public function inactive(string $id): object
    {
        $response = Http::contaAzul()->delete("/v1/customers/inactivate/$id");

        return $response->json();
    }
}
