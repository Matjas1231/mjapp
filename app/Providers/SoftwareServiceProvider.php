<?php

namespace App\Providers;

use App\Repository\Software\SoftwareRepository;
use App\Repository\SoftwareRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class SoftwareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SoftwareRepositoryInterface::class,
            SoftwareRepository::class,
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
