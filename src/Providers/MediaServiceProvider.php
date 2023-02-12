<?php

namespace LDK\Media\Providers;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfiguration();
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }
    }

    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    protected function registerConfiguration(): void
    {
        $this->mergeConfigFrom(__DIR__ . "/../../config/ldk-media.php", 'ldk-media');
    }
}
