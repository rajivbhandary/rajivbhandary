<?php

namespace App\Http\Controllers\frontend;

use App\Config;
use App\Http\Controllers\Controller;
use App\Page;
use App\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        $testimonial_count = Testimonial::count();
        $config = Config::first();
        $page_seo = Page::where('route_name', \Illuminate\Support\Facades\Request::route()->getName())->first();
        return view('frontend.testimonials', compact([
            'config',
            'page_seo',
            'testimonials',
            'testimonial_count'
        ]));
    }
}
