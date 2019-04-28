<?php

namespace CodeFinance\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\CodeFinance\Repositories\BankRepository::class, \CodeFinance\Repositories\BankRepositoryEloquent::class);
        //:end-bindings:
    }
}
