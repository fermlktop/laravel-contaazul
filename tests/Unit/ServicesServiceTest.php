<?php

namespace EliseuSantos\ContaAzul\Tests\Unit;

use EliseuSantos\ContaAzul\Services\ServicesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use EliseuSantos\ContaAzul\Tests\TestCase;

class ServicesServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::macro('contaAzul', null);
    }

    public function testCreateServiceSuccess()
    {
        Http::fake([
            '*/v1/services' => Http::response(['id' => 1, 'name' => 'Service A'], 200),
        ]);

        $service = new ServicesService();
        $data = [];
        $response = $service->createService($data);

        $this->assertArrayHasKey('id', $response);
        $this->assertEquals('Service A', $response['name']);
    }

//    public function testCreateServiceWithInvalidData()
//    {
//        // Simula um caso onde os dados enviados para criar um serviço são inválidos
//        // Implemente conforme necessário
//    }

    public function testCreateServiceCommunicationFailure()
    {
        Http::fake([
            '*/v1/services' => Http::response([], 500),
        ]);

        $service = new ServicesService();
        $data = [
            // Dados válidos para criação de um serviço
        ];
        $response = $service->createService($data);

        $this->assertNull($response);
    }
}
