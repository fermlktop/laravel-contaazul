<?php

namespace EliseuSantos\ContaAzul\Tests\Unit;

use EliseuSantos\ContaAzul\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use EliseuSantos\ContaAzul\Tests\TestCase;

class AuthServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Http::macro('contaAzul', null);
    }

    public function testGetAuthorizationUrl()
    {
        $authService = new AuthService();

        $redirectUri = 'http://example.com/callback';
        $state = 'random_state';

        Http::fake([
            'auth/authorize' => Http::response(['url' => 'http://example.com/auth'], 200)
        ]);

        $response = $authService->getAuthorizationUrl($redirectUri, $state);

        $this->assertEquals('http://example.com/auth', $response['url']);
    }

    public function testRequestAccessToken()
    {
        $authService = new AuthService();

        Http::fake([
            '*' => Http::response(['access_token' => 'fake_token'], 200)
        ]);

        $response = $authService->requestAccessToken('http://example.com/callback', 'fake_code');

        $this->assertEquals('fake_token', $response['access_token']);
    }

    public function testRefreshAccessToken()
    {
        $authService = new AuthService();

        Http::fake([
            '*' => Http::response(['access_token' => 'new_fake_token'], 200)
        ]);

        $response = $authService->refreshAccessToken('fake_refresh_token');

        $this->assertEquals('new_fake_token', $response['access_token']);
    }
}
