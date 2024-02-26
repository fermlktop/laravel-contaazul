<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class SaleService
{
    public function create(array $data): array
    {
        $response = Http::contaAzul()->post("/v1/sales", $data);

        return $response->json();
    }

    public function pdf(string $id): array
    {
        $response = Http::contaAzul()->get("/v1/sales/$id/pdf");
        $fileName = 'sale-pdf.pdf';

        return Response::make($response, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
        ]);
    }

    public function banks(string $id): array
    {
        $response = Http::contaAzul()->get("/v1/sales/banks");

        return $response->json();
    }

    public function update(string $saleId, array $data): array
    {
        $response = Http::contaAzul()->put("/v1/sales/$saleId", $data);

        return $response->json();
    }

    public function updateInstallment(string $saleId, string $numberInstallment, array $data): array
    {
        $response = Http::contaAzul()->put("/v1/sales/$saleId/installments/$numberInstallment", $data);

        return $response->json();
    }

    public function installmentsByNumber(string $saleId, string $numberInstallment): array
    {
        $response = Http::contaAzul()->get("/v1/sales/$saleId/installments/$numberInstallment");

        return $response->json();
    }

    public function report(array $filters=[]): array
    {
        $response = Http::contaAzul()->get("/v1/sales/totals", $filters);

        return $response->json();
    }

    public function items(string $saleId, array $filters=[]): array
    {
        $response = Http::contaAzul()->get("/v1/sales/$saleId/items");

        return $response->json();
    }

    public function byId(string $saleId): array
    {
        $response = Http::contaAzul()->get("/v1/sales/$saleId");

        return $response->json();
    }

    public function sellers(): array
    {
        $response = Http::contaAzul()->get("/v1/sales/sellers");

        return $response->json();
    }

    public function sales(): array
    {
        $response = Http::contaAzul()->get("/v1/sales");

        return $response->json();
    }

    public function delete(string $id): array
    {
        $response = Http::contaAzul()->delete("/v1/sales/$id");

        return $response->json();
    }
}
