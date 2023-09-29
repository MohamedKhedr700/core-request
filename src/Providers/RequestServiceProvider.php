<?php

namespace Raid\Core\Request\Providers;

use Illuminate\Support\ServiceProvider;
use Raid\Core\Action\Commands\CreateRequestCommand;
use Raid\Core\Request\Commands\PublishRequestCommand;
use Raid\Core\Request\Traits\Provider\WithRequestProvider;

class RequestServiceProvider extends ServiceProvider
{
    use WithRequestProvider;

    /**
     * The commands to be registered.
     */
    protected array $commands = [
        CreateRequestCommand::class,
        CreateRequestCommand::class,
        PublishRequestCommand::class,
    ];

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
