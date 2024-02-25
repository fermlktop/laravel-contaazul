<?php

namespace EliseuSantos\ContaAzul;

use EliseuSantos\ContaAzul\Services\AuthService;
use EliseuSantos\ContaAzul\Services\ContractService;
use EliseuSantos\ContaAzul\Services\CustomerService;
use EliseuSantos\ContaAzul\Services\PlanService;
use EliseuSantos\ContaAzul\Services\ProductService;
use EliseuSantos\ContaAzul\Services\SaleService;
use EliseuSantos\ContaAzul\Services\ServicesService;
use EliseuSantos\ContaAzul\Services\SupplierService;
use Illuminate\Support\Facades\Http;

class ContaAzul
{
    public function __construct() {}

    /**
     * @return AuthService
     */
    public function auth(): AuthService
    {
        return app(AuthService::class);
    }

    /**
     * @return ContractService
     */
    public function contract(): ContractService
    {
        return app(ContractService::class);
    }

    /**
     * @return CustomerService
     */
    public function customer(): CustomerService
    {
        return app(CustomerService::class);
    }

    /**
     * @return PlanService
     */
    public function plan(): PlanService
    {
        return app(PlanService::class);
    }

    /**
     * @return ProductService
     */
    public function product(): ProductService
    {
        return app(ProductService::class);
    }

    /**
     * @return SaleService
     */
    public function sale(): SaleService
    {
        return app(SaleService::class);
    }

    /**
     * @return ServicesService
     */
    public function service(): ServicesService
    {
        return app(ServicesService::class);
    }

    /**
     * @return SupplierService
     */
    public function supplier(): SupplierService
    {
        return app(SupplierService::class);
    }
}
