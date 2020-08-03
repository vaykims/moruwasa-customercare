<?php

namespace App\Providers;
use App\Technician;
use App\Observers\TechnicianObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Technician::observe(TechnicianObserver::class);
    }
}
