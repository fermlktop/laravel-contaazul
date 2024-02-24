<?php

namespace EliseuSantos\ContaAzul\Facades;

use EliseuSantos\ContaAzul\ContaAzulService;
use Illuminate\Support\Facades\Facade;

/**
 * @see \EliseuSantos\ContaAzul\ContaAzulService
 */
class ContaAzulFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ContaAzulService::class;
    }
}
