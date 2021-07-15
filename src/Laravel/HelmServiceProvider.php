<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Laravel;

use Illuminate\Support\ServiceProvider;
use tiagomichaelsousa\Helm\HelmClient;

class HelmServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/helm.php' => config_path('helm.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/helm.php', 'helm'
        );

        HelmClient::setHelmPath(config('helm.path', '/usr/local/bin/helm'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
