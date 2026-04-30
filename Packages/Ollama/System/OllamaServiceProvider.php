<?php

namespace App\Packages\Ollama\System;

use App\Domains\Marketplace\Contracts\ExtensionRegisterKeyProviderInterface;
use App\Domains\Marketplace\Contracts\UninstallExtensionServiceProviderInterface;
use Illuminate\Support\ServiceProvider;

class OllamaServiceProvider extends ServiceProvider implements ExtensionRegisterKeyProviderInterface, UninstallExtensionServiceProviderInterface
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ollama');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ollama');
    }

    public static function getExtensionRegisterKey(): string
    {
        return 'ollama';
    }

    public static function uninstall(): void
    {
        // Clean up any Ollama-specific data if needed
    }
}