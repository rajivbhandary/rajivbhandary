<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestForgery as Middleware;

/**
 * CSRF token and request-origin check for every form and AJAX POST.
 */
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from forgery protection.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
