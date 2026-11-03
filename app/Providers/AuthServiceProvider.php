<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User' => 'App\Policies\UsersPolicy',
        'App\Tag' => 'App\Policies\TagsPolicy',
        'App\Page' => 'App\Policies\PagesPolicy',
        'App\Config' => 'App\Policies\ConfigPolicy',
        'App\Blog' => 'App\Policies\BlogsPolicy',
        'App\Visit' => 'App\Policies\VisitsPolicy',
        'App\Testimonial' => 'App\Policies\TestimonialsPolicy',
        'App\Property' => 'App\Policies\PropertiesPolicy',
        'App\FRE' => 'App\Policies\FREPolicy',
        'App\Enquiry' => 'App\Policies\EnquiriesPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
