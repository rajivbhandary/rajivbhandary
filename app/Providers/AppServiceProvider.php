<?php

namespace App\Providers;

use App\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Every public page shows site settings (SEO defaults, contact details).
        View::composer('frontend.*', function ($view) {
            if (!$view->offsetExists('config') || !$view->offsetGet('config')) {
                $view->with('config', Config::current());
            }
        });
    }
}
