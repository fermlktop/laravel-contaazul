<?php

namespace EliseuSantos\ContaAzul\Tests\Unit;

use EliseuSantos\ContaAzul\Services\SupplierService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use EliseuSantos\ContaAzul\Tests\TestCase;

class SupplierServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::macro('contaAzul', null);
    }

    public function testCreateSupplierSuccess()
    {
        Http::fake([
            '*/v1/suppliers' => Http::response(['id' => 1, 'name' => 'Supplier A'], 200),
        ]);

        $service = new SupplierService();
        $data = [];
        $response = $service->createSupplier($data);

        $this->assertArrayHasKey('id', $response);
        $this->assertEquals('Supplier A', $response['name']);
    }

//    public function testCreateSupplierWithInvalidData()
//    {
//        // Simula um caso onde os dados enviados para criar um fornecedor são inválidos
//        // Implemente conforme necessário
//    }

    public function testCreateSupplierCommunicationFailure()
    {
        Http::fake([
            '*/v1/suppliers' => Http::response([], 500),
        ]);

        $service = new SupplierService();
        $data = [];
        $response = $service->createSupplier($data);

        $this->assertNull($response);
    }
}
