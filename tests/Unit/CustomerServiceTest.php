<?php

namespace EliseuSantos\ContaAzul\Tests\Unit;

use EliseuSantos\ContaAzul\Services\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use EliseuSantos\ContaAzul\Tests\TestCase;

class CustomerServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::macro('contaAzul', null);
    }

    public function testCreateCustomer()
    {
        $customerService = new CustomerService();

        $data = [
            'name' => 'Customer Name',
            'email' => 'customer@example.com',
        ];

        Http::fake([
            '*/v1/customers' => Http::response(['id' => '123', 'name' => 'Customer Name'], 201)
        ]);

        $response = $customerService->createCustomer($data);

        $this->assertEquals('123', $response['id']);
        $this->assertEquals('Customer Name', $response['name']);
    }

    public function testGetCustomers()
    {
        $customerService = new CustomerService();

        Http::fake([
            '*/v1/customers' => Http::response([['id' => '123', 'name' => 'Customer 1'], ['id' => '456', 'name' => 'Customer 2']], 200)
        ]);

        $response = $customerService->getCustomers();

        $this->assertCount(2, $response);
        $this->assertEquals('123', $response[0]['id']);
        $this->assertEquals('Customer 1', $response[0]['name']);
        $this->assertEquals('456', $response[1]['id']);
        $this->assertEquals('Customer 2', $response[1]['name']);
    }

    public function testGetCustomerContacts()
    {
        $customerService = new CustomerService();

        $customerId = '123';
        $filters = ['param' => 'value'];

        Http::fake([
            "*/v1/customers/$customerId/contacts" => Http::response(['id' => '789', 'name' => 'Contact 1'], 200)
        ]);

        $response = $customerService->getCustomerContacts($customerId, $filters);

        $this->assertCount(1, $response);
        $this->assertEquals('789', $response[0]['id']);
        $this->assertEquals('Contact 1', $response[0]['name']);
    }

    public function testGetCustomerById()
    {
        $customerService = new CustomerService();

        $customerId = '123';

        Http::fake([
            "*/v1/customers/$customerId" => Http::response(['id' => '123', 'name' => 'Customer 1'], 200)
        ]);

        $response = $customerService->getCustomerById($customerId);

        $this->assertEquals('123', $response['id']);
        $this->assertEquals('Customer 1', $response['name']);
    }

    public function testUpdateCustomer()
    {
        $customerService = new CustomerService();

        $customerId = '123';
        $data = ['name' => 'Updated Customer'];

        Http::fake([
            "*/v1/customers/$customerId" => Http::response(['id' => '123', 'name' => 'Updated Customer'], 200)
        ]);

        $response = $customerService->updateCustomer($customerId, $data);

        $this->assertEquals('123', $response['id']);
        $this->assertEquals('Updated Customer', $response['name']);
    }

    public function testDeleteCustomer()
    {
        $customerService = new CustomerService();

        $customerId = '123';

        Http::fake([
            "*/v1/customers/$customerId" => Http::response(null, 204)
        ]);

        $response = $customerService->deleteCustomer($customerId);

        $this->assertNull($response);
    }

    public function testInactiveCustomer()
    {
        $customerService = new CustomerService();

        $customerId = '123';

        Http::fake([
            "*/v1/customers/inactivate/$customerId" => Http::response(['id' => '123', 'status' => 'inactive'], 200)
        ]);

        $response = $customerService->inactiveCustomer($customerId);

        $this->assertEquals('123', $response['id']);
        $this->assertEquals('inactive', $response['status']);
    }
}
