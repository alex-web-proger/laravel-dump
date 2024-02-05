<?php

namespace Alexlen\Dump\Providers;

use Alexlen\Dump\Console\Commands\DumpBackup;
use Alexlen\Dump\Console\Commands\DumpBackupClear;
use Alexlen\Dump\Console\Commands\DumpExport;
use Alexlen\Dump\Console\Commands\DumpHelp;
use Alexlen\Dump\Console\Commands\DumpImport;
use Alexlen\Dump\Console\Commands\DumpRestore;
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
                DumpHelp::class,
                DumpBackup::class,
                DumpBackupClear::class,
                DumpRestore::class,
            ]);
        }
    }
}
