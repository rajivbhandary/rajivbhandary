<?php

namespace App\Providers;

use App\Config;
use Illuminate\Pagination\Paginator;
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
        // The site is styled with Bootstrap 4.
        Paginator::useBootstrapFour();

        // Every public page shows site settings (SEO defaults, contact details).
        View::composer('frontend.*', function ($view) {
            if (!$view->offsetExists('config') || !$view->offsetGet('config')) {
                $view->with('config', Config::current());
            }
        });
    }
}
