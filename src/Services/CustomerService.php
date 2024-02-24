<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;

class CustomerService
{
    public function createCustomer(array $data): object
    {
        $response = Http::contaAzul()->post("/v1/customers", $data);

        return $response->json();
    }

    public function getCustomers(): array
    {
        $response = Http::contaAzul()->get('/v1/customers');

        return $response->json();
    }

    public function getCustomerContacts(string $id, array $filters): array
    {
        $response = Http::contaAzul()->get("/v1/customers/$id/contacts", $filters);

        return $response->json();
    }

    public function getCustomerById(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/customers/$id");

        return $response->json();
    }

    public function updateCustomer(string $id, array $data): object
    {
        $response = Http::contaAzul()->put("/v1/customers/$id", $data);

        return $response->json();
    }

    public function deleteCustomer(string $id): object
    {
        $response = Http::contaAzul()->delete("/v1/customers/$id");

        return $response->json();
    }

    public function inactiveCustomer(string $id): object
    {
        $response = Http::contaAzul()->delete("/v1/customers/inactivate/$id");

        return $response->json();
    }
}
