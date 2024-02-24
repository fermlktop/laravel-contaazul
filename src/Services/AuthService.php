<?php

namespace EliseuSantos\ContaAzul\Services;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;

class AuthService
{
    private string $clientId;
    private string $clientSecret;

    public function __construct()
    {
        $this->clientId = config('contaazul.client_id');
        $this->clientSecret = config('contaazul.client_secret');
    }

    public function getAuthorizationUrl($redirectUri, $state)
    {
        $response = Http::contaAzul()->get("auth/authorize", [
            'client_id' => config('contaazul.client_id'),
            'redirect_uri' => $redirectUri,
            'scope' => 'sales',
            'state' => $state,
        ]);

        return $response->json();
    }

    public function requestAccessToken($redirectUri, $code)
    {
        try {
            $authService = app(AuthService::class);
            $token = $authService->getToken();

            // Verifica se o token está expirado
            if ($authService->isTokenExpired()) {
                // Se estiver expirado, obtenha um novo token usando o refresh token
                $token = $authService->refreshToken();
            }

            $response = Http::contaAzul()->post('oauth2/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => $redirectUri,
                    'code' => $code,
                ],
            ]);
            return $response->json();
        } catch (ClientException) {
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
        } catch (ClientException) {
            // Handle exception
            return null;
        }
    }
}
