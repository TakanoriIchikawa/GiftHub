<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryBindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Prize\PrizeRepositoryInterface::class,
            \App\Repositories\Prize\PrizeRepository::class
        );
        $this->app->bind(
            \App\Repositories\PrizeCategory\PrizeCategoryRepositoryInterface::class,
            \App\Repositories\PrizeCategory\PrizeCategoryRepository::class
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
