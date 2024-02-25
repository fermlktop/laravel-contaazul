<?php

namespace EliseuSantos\ContaAzul\Providers;

use EliseuSantos\ContaAzul\Services\AuthService;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use EliseuSantos\ContaAzul\ContaAzul;

class ContaAzulServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Configs/contaazul.php',
            'contaazul'
        );

        $this->app->singleton(ContaAzul::class, fn ($app) => new ContaAzul);
    }

    public function boot(): void
    {
        Http::macro('contaAzul', function (bool $useToken = true): PendingRequest {
            $authService = app(AuthService::class);
            $request = Http::baseUrl(config('contaazul.base_uri'));

            if ($useToken) {
                $token = $authService->getSessionToken();
                $request = $request->withToken($token);
            }

            return $request;
        });

        $this->publishes([
            __DIR__.'/../Configs/contaazul.php' => config_path('contaazul.php'),
            __DIR__.'/../Views' => resource_path('views/vendor/contaazul'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../Views', 'contaazul');

        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        $router = $this->app['router'];
        $router->group(['namespace' => 'EliseuSantos\ContaAzul\Controllers'], function ($router) {
            require __DIR__.'/../Routes/routes.php';
        });
    }
}
