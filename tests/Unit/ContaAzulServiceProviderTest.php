<?php

namespace EliseuSantos\ContaAzul\Tests\Unit;

use EliseuSantos\ContaAzul\Providers\ContaAzulServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use EliseuSantos\ContaAzul\Tests\TestCase;

class ContaAzulServiceProviderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::macro('contaAzul', null);
    }

    public function testServiceProviderRegistersMacro()
    {
        $provider = new ContaAzulServiceProvider($this->app);
        $provider->boot();

        $this->assertTrue(Http::hasMacro('contaAzul'));
    }

    public function testServiceProviderPublishesConfig()
    {
        $provider = new ContaAzulServiceProvider($this->app);
        $provider->boot();

        $this->assertArrayHasKey(
            __DIR__.'/../../../config/contaazul.php',
            $this->app->getLoadedProviders()['EliseuSantos\ContaAzul\Providers\ContaAzulServiceProvider']->publishes
        );
    }

    public function testMacroReturnsHttpPendingRequest()
    {
        Config::set('contaazul.token', 'fake_token');
        Config::set('contaazul.base_uri', 'http://example.com/api');

        $request = Http::contaAzul();

        $this->assertInstanceOf(\Illuminate\Http\Client\PendingRequest::class, $request);
    }
}
