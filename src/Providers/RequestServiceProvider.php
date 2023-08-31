<?php

namespace Raid\Core\Request\Http\Providers;

use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
    /**
     * The commands to be registered.
     */
    protected array $commands = [];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerMacros();
        $this->registerHelpers();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerCustomValidationRules();
    }
}