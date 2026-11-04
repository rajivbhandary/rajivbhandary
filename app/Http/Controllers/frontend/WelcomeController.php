<?php

namespace App\Http\Controllers\frontend;

use App\Blog;
use App\Config;
use App\Http\Controllers\Controller;
use App\Page;
use App\Property;
use App\Testimonial;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::withoutTrashed()->latest('published_at')->approved()->published()->limit(6)->get();
        $config = Config::first();
        $testimonials = Testimonial::latest()->limit(6)->get();
        $properties = Property::latest()->limit(6)->get();
        $property_count = Property::count() - 6;
        $page_seo = Page::where('route_name', \Illuminate\Support\Facades\Request::route()->getName())->first();    
        $property_types = [["id" => 1, "value" =>'Residential'],["id" => 2, "value" =>'Commercial']];
    
        return view('frontend.welcome', compact([
            'config',
            'page_seo',
            'blogs',
            'properties',
            'testimonials',
            'property_count',
            'property_types',
        ]));
    }

    public function contact(){
        $config = Config::first();
        $page_seo = Page::where('route_name', \Illuminate\Support\Facades\Request::route()->getName())->first();
        return view('frontend.contact-us', compact([
            'config',
            'page_seo',
        ]));
    }

    public function about(){
        $config = Config::first();
        $page_seo = Page::where('route_name', \Illuminate\Support\Facades\Request::route()->getName())->first();
        return view('frontend.about-us', compact([
            'config',
            'page_seo',
        ]));
    }

    public function privacy()
    {
        $page_seo = Page::where('route_name', 'frontend.privacy')->first();

        return view('frontend.privacy-policy', compact('page_seo'));
    }
}
