<?php

namespace Alexlen\Dump\Providers;

use Alexlen\Dump\Console\Commands\DumpExport;
use Alexlen\Dump\Console\Commands\DumpImport;
use Illuminate\Support\ServiceProvider;

class DumpServiceProvider extends ServiceProvider
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
        if ($this->app->runningInConsole()) {
            $this->commands([
                DumpExport::class,
                DumpImport::class,
            ]);
        }
    }
}
