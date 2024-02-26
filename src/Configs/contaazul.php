<?php

return [
    'base_uri' => env('CONTA_AZUL_BASE_URI', 'https://api.contaazul.com'),
    'redirect_uri_authentication' => env('CONTA_AZUL_REDIRECT_URI_AUTHENTICATION', '/contaazul-authentication'),
    'redirect_uri_authorization' => env('CONTA_AZUL_REDIRECT_URI_AUTHORIZATION', '/contaazul-authorization'),
    'client_id' => env('CONTA_AZUL_CLIENT_ID', ''),
    'client_secret' => env('CONTA_AZUL_CLIENT_SECRET', ''),
];
