<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use package_examples\package_example_01\Services\IInfomationService;
use package_examples\package_example_01\Services\InfoPersonVehicleService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IInfomationService::class,InfoPersonVehicleService::class);
    }
}
