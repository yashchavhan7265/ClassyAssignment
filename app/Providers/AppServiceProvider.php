<?php

namespace App\Providers;

use App\Address;
use Illuminate\Support\ServiceProvider;
use App\User;
use App\Observers\ModelObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(new \App\Observers\ModelObserver);
        Address::observe(new \App\Observers\ModelObserver);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
