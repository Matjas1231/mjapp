<?php

namespace App\Providers;

use App\Repository\Peripheral\PeripheralRepository;
use App\Repository\PeripheralRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class PeripheralServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            PeripheralRepositoryInterface::class,
            PeripheralRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
