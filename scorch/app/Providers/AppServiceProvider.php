<?php

namespace App\Providers;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

use App\Models\DeviceStatus;
use App\Observers\DeviceStatusObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        DeviceStatus::observe(DeviceStatusObserver::class);

        Blade::directive('routeIs', function ($expression) {
            return "<?php if(Request::url() == route($expression)): ?>";
        });
    }
}
