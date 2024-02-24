<?php

namespace EliseuSantos\ContaAzul\Tests;

use EliseuSantos\ContaAzul\Providers\ContaAzulServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp() : void
    {
        parent::setUp();

        $this->setupEnvironment(app());
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ContaAzulServiceProvider::class,
        ];
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setupEnvironment($app)
    {
        if (env('CONTAAZUL_USE_LIVE_API')) {
            $app['config']->set('contaazul.client_key');
            $app['config']->set('contaazul.client_secret');
        }
    }
}
