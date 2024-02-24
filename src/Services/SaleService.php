<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class SaleService
{
    public function createSale(array $data): object
    {
        $response = Http::contaAzul()->post("/v1/sales", $data);

        return $response->json();
    }

    public function getPdfSale(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/sales/$id/pdf");
        $fileName = 'sale-pdf.pdf';

        return Response::make($response, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
        ]);
    }

    public function getSalesBanks(string $id): object
    {
        $response = Http::contaAzul()->get("/v1/sales/banks");

        return $response->json();
    }

    public function updateSale(string $saleId, array $data): object
    {
        $response = Http::contaAzul()->put("/v1/sales/$saleId", $data);

        return $response->json();
    }

    public function updateSaleInstallment(string $saleId, string $numberInstallment, array $data): object
    {
        $response = Http::contaAzul()->put("/v1/sales/$saleId/installments/$numberInstallment", $data);

        return $response->json();
    }

    public function getSaleInstallments(string $saleId, string $numberInstallment): object
    {
        $response = Http::contaAzul()->get("/v1/sales/$saleId/installments/$numberInstallment");

        return $response->json();
    }

    public function getSalesReport(array $filters): object
    {
        $response = Http::contaAzul()->get("/v1/sales/totals", $filters);

        return $response->json();
    }

    public function getItemsSales(string $saleId, array $filters=[]): object
    {
        $response = Http::contaAzul()->get("/v1/sales/$saleId/items");

        return $response->json();
    }

    public function getSaleById(string $saleId): object
    {
        $response = Http::contaAzul()->get("/v1/sales/$saleId");

        return $response->json();
    }

    public function getSellers(): object
    {
        $response = Http::contaAzul()->get("/v1/sales/sellers");

        return $response->json();
    }

    public function getSales(): object
    {
        $response = Http::contaAzul()->get("/v1/sales");

        return $response->json();
    }

    public function deleteSale(string $id): object
    {
        $response = Http::contaAzul()->delete("/v1/sales/$id");

        return $response->json();
    }
}
