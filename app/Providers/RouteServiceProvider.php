<?php

namespace App\Providers;

use App\Blog;
use App\FRE;
use App\Property;
use App\Tag;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/control-panel/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('slug', function($slug){
            if(Request::route()->named('frontend.single-property')){
                return Property::withoutTrashed()->where('slug', $slug)->firstOrFail();
            }
            if(Request::route()->named('frontend.single-fre')){
                return FRE::withoutTrashed()->where('slug', $slug)->firstOrFail();
            }
            if(Request::route()->named('blogs.single-blog-preview')){
                return Blog::withTrashed()->where('slug', $slug)->firstOrFail();
            }
            if(Request::route()->named('blogs.preview.tag')){
                return Tag::withTrashed()->where('slug', $slug)->firstOrFail();
            }
            if(Request::route()->named('frontend.blogs.tag')){
                return Tag::withoutTrashed()->where('slug', $slug)->firstOrFail();
            }
            if(Request::route()->named('frontend.single-blog')){
                return Blog::withoutTrashed()->approved()->published()->where('slug', $slug)->firstOrFail();
            }
        });
        

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
