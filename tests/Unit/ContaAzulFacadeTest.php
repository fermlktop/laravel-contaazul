<?php

namespace EliseuSantos\ContaAzul\Tests\Unit;

use EliseuSantos\ContaAzul\Facades\ContaAzulFacade;
use EliseuSantos\ContaAzul\ContaAzul;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EliseuSantos\ContaAzul\Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ContaAzulFacadeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::macro('contaAzul', null);
    }

    public function testFacadeAccessorReturnsCorrectClass()
    {
        $facadeAccessor = ContaAzulFacade::getFacadeAccessor();

        $this->assertEquals(ContaAzul::class, $facadeAccessor);
    }
}
