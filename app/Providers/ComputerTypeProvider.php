<?php

namespace App\Providers;

use App\Repository\Computer\ComputerTypeRepository;
use App\Repository\ComputerTypeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ComputerTypeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ComputerTypeRepositoryInterface::class,
            ComputerTypeRepository::class
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
