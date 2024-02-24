<?php

namespace EliseuSantos\ContaAzul\Tests\Unit;

use EliseuSantos\ContaAzul\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use EliseuSantos\ContaAzul\Tests\TestCase;

class ProductServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::macro('contaAzul', null);
    }

    public function testCreateProduct()
    {
        $productService = new ProductService();
        $postData = ['name' => 'Product A', 'price' => 100];

        Http::fake([
            '*/v1/products' => Http::response(['id' => '123', 'name' => 'Product A', 'price' => 100], 200)
        ]);

        $response = $productService->createProduct($postData);

        $this->assertEquals('123', $response['id']);
        $this->assertEquals('Product A', $response['name']);
        $this->assertEquals(100, $response['price']);
    }

    public function testGetProducts()
    {
        $productService = new ProductService();

        Http::fake([
            '*/v1/products' => Http::response([['id' => '123', 'name' => 'Product A', 'price' => 100]], 200)
        ]);

        $response = $productService->getProducts();

        $this->assertCount(1, $response);
        $this->assertEquals('123', $response[0]['id']);
        $this->assertEquals('Product A', $response[0]['name']);
        $this->assertEquals(100, $response[0]['price']);
    }

    public function testGetCategory()
    {
        $productService = new ProductService();

        Http::fake([
            '*/v1/product-categories/1' => Http::response(['id' => '1', 'name' => 'Category A'], 200)
        ]);

        $response = $productService->getCategory('1');

        $this->assertEquals('1', $response['id']);
        $this->assertEquals('Category A', $response['name']);
    }

    public function testGetCategories()
    {
        $productService = new ProductService();

        Http::fake([
            '*/v1/product-categories' => Http::response([['id' => '1', 'name' => 'Category A']], 200)
        ]);

        $response = $productService->getCategories();

        $this->assertCount(1, $response);
        $this->assertEquals('1', $response[0]['id']);
        $this->assertEquals('Category A', $response[0]['name']);
    }

    public function testGetProductById()
    {
        $productService = new ProductService();

        Http::fake([
            '*/v1/products/1' => Http::response(['id' => '1', 'name' => 'Product A', 'price' => 100], 200)
        ]);

        $response = $productService->getProductById('1');

        $this->assertEquals('1', $response['id']);
        $this->assertEquals('Product A', $response['name']);
        $this->assertEquals(100, $response['price']);
    }

    public function testUpdateProductById()
    {
        $productService = new ProductService();
        $updateData = ['name' => 'Product B', 'price' => 200];

        Http::fake([
            '*/v1/products/1' => Http::response(['id' => '1', 'name' => 'Product B', 'price' => 200], 200)
        ]);

        $response = $productService->updateProductById('1', $updateData);

        $this->assertEquals('1', $response['id']);
        $this->assertEquals('Product B', $response['name']);
        $this->assertEquals(200, $response['price']);
    }

    public function testDeleteProductById()
    {
        $productService = new ProductService();

        Http::fake([
            '*/v1/products/1' => Http::response(['id' => '1', 'message' => 'Product deleted successfully'], 200)
        ]);

        $response = $productService->deleteProductById('1');

        $this->assertEquals('1', $response['id']);
        $this->assertEquals('Product deleted successfully', $response['message']);
    }
}
