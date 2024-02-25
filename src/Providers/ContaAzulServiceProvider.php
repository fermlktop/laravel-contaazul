<?php

namespace EliseuSantos\ContaAzul\Providers;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use EliseuSantos\ContaAzul\ContaAzul;

class ContaAzulServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/contaazul.php',
            'contaazul'
        );

        $this->app->singleton(ContaAzul::class, fn ($app) => new ContaAzul);
    }

    public function boot(): void
    {
        Http::macro('contaAzul', function (): PendingRequest {
            $token = app(AuthService::class)->getToken();
            return Http::withToken($token)
                ->baseUrl(config('contaazul.base_uri'));
        });

        $this->publishes([
            __DIR__.'/../../config/contaazul.php' => config_path('contaazul.php'),
        ]);
    }
}
