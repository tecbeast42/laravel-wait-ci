<?php

namespace Tecbeast42\LaravelWaitCi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tecbeast42\LaravelWaitCi\Commands\LaravelWaitCiCommand;

class LaravelWaitCiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-wait-ci')
            ->hasCommand(LaravelWaitCiCommand::class);
    }
}
