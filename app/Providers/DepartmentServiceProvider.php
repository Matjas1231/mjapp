<?php

namespace App\Providers;

use App\Repository\Department\DepartmentRepository;
use App\Repository\DepartmentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class DepartmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            DepartmentRepositoryInterface::class,
            DepartmentRepository::class,
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
