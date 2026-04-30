<?php

namespace modaui\Healthy;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use modaui\Healthy\Commands\HealthyCommand;
use modaui\Healthy\Http\Controllers\HealthyController;
use modaui\Healthy\Http\Middleware\HealthyMiddleware;
use modaui\Updater\View\Components\Button;
use modaui\Updater\View\Components\Li;
use modaui\Updater\View\Components\Permission;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HealthyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('modaui-healthy')
            ->hasConfigFile()
            ->hasViews()
            ->hasViewComponents('healthy', Permission::class, Li::class, Button::class)
            ->hasCommand(HealthyCommand::class);
    }

    public function bootingPackage()
    {
        $this->app->make(Router::class)->aliasMiddleware(
            'healthy',
            HealthyMiddleware::class
        );
    }

    public function packageRegistered(): void
    {
        Route::prefix('healthy')
            ->as('healthy.')
            ->middleware(['api'])
            ->group(function (Router $router) {
                $router->get('check/selected', [HealthyController::class, 'checkSelected'])
                    ->name('check.selected');
                $router->get('check/all', [HealthyController::class, 'checkAll'])
                    ->name('check.all');
            });
    }
}
