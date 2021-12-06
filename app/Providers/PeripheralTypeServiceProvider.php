<?php

namespace App\Providers;

use App\Repository\Peripheral\PeripheralTypeRepository;
use App\Repository\PeripheralTypeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class PeripheralTypeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PeripheralTypeRepositoryInterface::class,
            PeripheralTypeRepository::class,
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
