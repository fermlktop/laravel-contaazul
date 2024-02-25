<?php

namespace EliseuSantos\ContaAzul\Controllers;

use EliseuSantos\ContaAzul\Services\AuthService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ContaAzulController extends BaseController
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function authorization(Request $request)
    {
        return response()->view('contaazul::authorize', ['uri_authorize' => $this->authService->getAuthorizationUrl()]);
    }

    public function authentication(Request $request)
    {
        $authenticationSuccessful = $this->authService->handleAuthentication($request->code, $request->state);

        if(!$authenticationSuccessful) {
            return redirect(config('contaazul.redirect_uri_authorization'));
        }

        return true;
    }
}
