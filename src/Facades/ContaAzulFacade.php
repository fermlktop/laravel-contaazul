<?php

namespace EliseuSantos\ContaAzul\Facades;

use EliseuSantos\ContaAzul\ContaAzul;
use Illuminate\Support\Facades\Facade;

/**
 * @see \EliseuSantos\ContaAzul\ContaAzul
 */
class ContaAzulFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ContaAzul::class;
    }
}
