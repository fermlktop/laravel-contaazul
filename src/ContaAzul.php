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
    protected AuthService $authService;
    protected ContractService $contractService;
    protected CustomerService $customerService;
    protected PlanService $planService;
    protected ProductService $productService;
    protected SaleService $saleService;
    protected ServicesService $servicesService;
    protected SupplierService $supplierService;

    public function __construct(
        AuthService $authService,
        ContractService $contractService,
        CustomerService $customerService,
        PlanService $planService,
        ProductService $productService,
        SaleService $saleService,
        ServicesService $servicesService,
        SupplierService $supplierService,
    ) {
        $this->authService = $authService;
        $this->contractService = $contractService;
        $this->customerService = $customerService;
        $this->planService = $planService;
        $this->productService = $productService;
        $this->saleService = $saleService;
        $this->servicesService = $servicesService;
        $this->supplierService = $supplierService;
    }

    /**
     * @return AuthService
     */
    public function auth(): AuthService
    {
        return $this->authService;
    }

    /**
     * @return ContractService
     */
    public function contract(): ContractService
    {
        return $this->contractService;
    }

    /**
     * @return CustomerService
     */
    public function customer(): CustomerService
    {
        return $this->customerService;
    }

    /**
     * @return PlanService
     */
    public function plan(): PlanService
    {
        return $this->planService;
    }

    /**
     * @return ProductService
     */
    public function product(): ProductService
    {
        return $this->productService;
    }

    /**
     * @return SaleService
     */
    public function sale(): SaleService
    {
        return $this->saleService;
    }

    /**
     * @return ServicesService
     */
    public function service(): ServicesService
    {
        return $this->servicesService;
    }

    /**
     * @return SupplierService
     */
    public function supplier(): SupplierService
    {
        return $this->supplierService;
    }
}
