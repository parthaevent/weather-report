<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\WeatherRepository;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\WeatherInterface',
            function () {
                return new WeatherRepository();
            }
        );
    }
}
