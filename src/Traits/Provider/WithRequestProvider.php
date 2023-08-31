<?php

namespace Raid\Core\Request\Traits\Provider;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Validator;
use Raid\Core\Request\Events\Contracts\EventActionInterface;
use Raid\Core\Request\Facades\Events\Event;

trait WithRequestProvider
{
    /**
     * Register config.
     */
    private function registerConfig(): void
    {
        $configResourcePath = glob(__DIR__.'/../../../config/*.php');

        foreach ($configResourcePath as $config) {

            $this->publishes([
                $config => config_path(basename($config)),
            ], 'config');
        }
    }

    /**
     * Register all core macros.
     */
    private function registerMacros(): void
    {
        foreach (config('request.macros', []) as $original => $mixin) {
            $mixinObject = new $mixin;

            $original::mixin($mixinObject);
        }
    }

    /**
     * Register helpers.
     */
    private function registerHelpers(): void
    {
        $helpers = glob(__DIR__.'/../../Http/Helpers/*.php');

        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }

    /**
     * Register stubs.
     */
    private function registerStubs(): void
    {
        $stubs = __DIR__.'/../../../resources/stubs/';

        $this->publishes([
            $stubs => app_path('Console/laravel-modules/stubs'),
        ], 'stubs');
    }

    /**
     * Register commands.
     */
    private function registerCommands(): void
    {
        $this->commands($this->commands);
    }

    /**
     * Register custom validation rules.
     */
    private function registerCustomValidationRules(): void
    {
        foreach (config('validation.custom_rules', []) as $rule => $class) {
            Validator::extend($rule, is_string($class) ? $class.'@passes' : $class[0].'@'.$class[1]);
        }
    }
}
