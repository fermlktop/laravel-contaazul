<?php

namespace EliseuSantos\ContaAzul\Tests\Unit;

use EliseuSantos\ContaAzul\Services\ContractService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use EliseuSantos\ContaAzul\Tests\TestCase;

class ContractServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::macro('contaAzul', null);
    }

    public function testCreateContract()
    {
        $contractService = new ContractService();

        $data = [
            'name' => 'Contract Name',
            'amount' => 1000,
        ];

        Http::fake([
            '*/v1/contracts' => Http::response(['id' => '123', 'name' => 'Contract Name'], 201)
        ]);

        $response = $contractService->createContract($data);

        $this->assertEquals('123', $response['id']);
        $this->assertEquals('Contract Name', $response['name']);
    }

    public function testGetContractById()
    {
        $contractService = new ContractService();

        $contractId = '123';

        Http::fake([
            '*/v1/contracts/*' => Http::response(['id' => '123', 'name' => 'Contract Name'], 200)
        ]);

        $response = $contractService->getContractById($contractId);

        $this->assertEquals('123', $response['id']);
        $this->assertEquals('Contract Name', $response['name']);
    }
}
