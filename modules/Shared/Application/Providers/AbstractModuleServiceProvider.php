<?php

declare(strict_types=1);

namespace Modules\Shared\Application\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

abstract class AbstractModuleServiceProvider extends RouteServiceProvider
{
    /**
     * Return namespace of module.
     * e.g. Use full root namespace to module - '\Namespace\Module'.
     */
    abstract protected function getModuleNamespace(): string;

    /**
     * Return path of module.
     */
    abstract protected function getModulePath(): string;

    /**
     * Return stack of providers inside context module.
     */
    abstract protected function getProvidersStack(): array;

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(
            base_path(trim($this->getModulePath()) . '/Database/Migrations')
        );

        $this->loadRouteConfigFiles();

        parent::boot();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->getProvidersStack() as $provider) {
            $this->app->register($provider);
        }

        parent::register();
    }

    private function loadRouteConfigFiles(): void
    {
        $path = base_path(trim($this->getModulePath()) . '/Presentation/Routes/');

        foreach (glob($path . '*.php') as $routesConfigFile) {
            $this->loadRoutesFrom($routesConfigFile);
        }
    }
}
