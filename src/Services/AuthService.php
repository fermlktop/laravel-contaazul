<?php

namespace EliseuSantos\ContaAzul\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;

class AuthService
{
    private string $clientId;
    private string $clientSecret;
    private string $redirectUriAuthentication;
    private string $redirectUriAuthorization;
    private string $baseUrl;
    private string $state;

    public const SCOPE = 'sales';

    public function __construct()
    {
        $this->clientId = config('contaazul.client_id');
        $this->clientSecret = config('contaazul.client_secret');
        $this->redirectUriAuthentication = url(config('contaazul.redirect_uri_authentication'));
        $this->redirectUriAuthorization = url(config('contaazul.redirect_uri_authorization'));
        $this->baseUrl = config('contaazul.base_uri');
        $this->state = 'XCEeFWf45A53sdfKef424';
    }

    public function getAuthorizationUrl()
    {
        return "{$this->baseUrl}/auth/authorize?client_id={$this->clientId}&redirect_uri={$this->redirectUriAuthentication}&scope=".self::SCOPE."&state={$this->state}";
    }

    public function getSessionToken(): string
    {
        $token = Cache::get('access_token');
        $expiresIn = Cache::get('token_expires_in');
        if (!$token || now()->gte($expiresIn)) {
            $refreshToken = Cache::get('refresh_token');

            $newTokenData = $this->refreshAccessToken($refreshToken);

            Cache::put('access_token', $newTokenData['access_token']);
            Cache::put('refresh_token', $newTokenData['refresh_token'] ?? $refreshToken);
            Cache::put('token_expires_in', now()->addSeconds($newTokenData['expires_in']));

            $token = $newTokenData['access_token'];
        }

        return $token;
    }

    public function requestAccessToken($code)
    {
        try {
            $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");
            $response = Http::contaAzul(false)->withHeaders([
                'Authorization' => "Basic {$credentials}",
            ])->post('/oauth2/token', [
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirectUriAuthentication,
                'code' => $code,
            ]);

            return $response->json();
        } catch (\Exception $e) {
            // Handle exception
            return null;
        }
    }

    public function refreshAccessToken($refreshToken)
    {
        try {
            $response = Http::contaAzul()->post('oauth2/token', [
                'headers' => [
                    'Authorization' => 'Basic '.base64_encode("$this->clientId:$this->clientSecret"),
                ],
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                ],
            ]);
            return $response->json();
        } catch (\Exception) {
            // Handle exception
            return null;
        }
    }

    public function handleAuthentication(string $code, string $state): bool
    {
        $response = $this->requestAccessToken($code);

        if (isset($response['access_token'])) {
            Cache::put('access_token', $response['access_token']);
            Cache::put('refresh_token', $response['refresh_token']);
            Cache::put('token_expires_in', now()->addSeconds($response['expires_in']));

            return true;
        }

        return false;
    }
}
