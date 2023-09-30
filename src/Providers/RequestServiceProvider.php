<?php

namespace Raid\Core\Request\Providers;

use Illuminate\Support\ServiceProvider;
use Raid\Core\Request\Commands\CreateCommonRequestCommand;
use Raid\Core\Request\Commands\CreateRequestCommand;
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
        CreateCommonRequestCommand::class,
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
        $this->registerCommands();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerCustomValidationRules();
    }
}
