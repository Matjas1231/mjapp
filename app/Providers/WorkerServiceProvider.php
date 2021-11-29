<?php

namespace App\Providers;

use App\Repository\WorkerRepositoryInterface;
use App\Repository\Worker\WorkerRepository;
use Illuminate\Support\ServiceProvider;

class WorkerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            WorkerRepositoryInterface::class,
            WorkerRepository::class
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
