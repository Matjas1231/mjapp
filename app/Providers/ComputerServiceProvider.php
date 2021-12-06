<?php

namespace App\Providers;

use App\Repository\Computer\ComputerRepository;
use App\Repository\ComputerRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ComputerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ComputerRepositoryInterface::class,
            ComputerRepository::class,
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
