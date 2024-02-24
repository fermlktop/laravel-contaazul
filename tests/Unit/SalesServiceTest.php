<?php

namespace EliseuSantos\ContaAzul\Tests\Unit;

use EliseuSantos\ContaAzul\Services\SaleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use EliseuSantos\ContaAzul\Tests\TestCase;

class SalesServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::macro('contaAzul', null);
    }

    public function testCreateSaleSuccess()
    {
        Http::fake([
            '*/v1/sales' => Http::response(['id' => 1, 'status' => 'created'], 200),
        ]);

        $service = new SaleService();
        $data = [];
        $response = $service->createSale($data);

        $this->assertArrayHasKey('id', $response);
        $this->assertEquals('created', $response['status']);
    }

//    public function testCreateSaleWithInvalidData()
//    {
//        // Simula um caso onde os dados enviados para criar uma venda são inválidos
//        // Implemente conforme necessário
//    }

    public function testCreateSaleCommunicationFailure()
    {
        Http::fake([
            '*/v1/sales' => Http::response([], 500),
        ]);

        $service = new SaleService();
        $data = [];
        $response = $service->createSale($data);

        $this->assertNull($response);
    }
}
