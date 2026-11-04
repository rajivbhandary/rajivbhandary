<?php

namespace App\Http\Controllers\frontend;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Page;
use App\Property;
use App\Testimonial;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::withoutTrashed()->latest('published_at')->approved()->published()->with('author')->limit(6)->get();
        $testimonials = Testimonial::latest()->limit(6)->get();
        $properties = Property::latest()->with(['location', 'rentDetail', 'residential'])->withCount('image')->limit(6)->get();
        // Listings beyond the six shown on the homepage (never negative).
        $property_count = max(0, Property::count() - $properties->count());
        $page_seo = Page::where('route_name', 'frontend.index')->first();

        return view('frontend.welcome', compact('page_seo', 'blogs', 'properties', 'testimonials', 'property_count'));
    }

    public function contact(){
        $page_seo = Page::where('route_name', 'frontend.contact-us')->first();

        return view('frontend.contact-us', compact('page_seo'));
    }

    public function about(){
        $page_seo = Page::where('route_name', 'frontend.about-us')->first();

        return view('frontend.about-us', compact('page_seo'));
    }

    public function privacy()
    {
        $page_seo = Page::where('route_name', 'frontend.privacy')->first();

        return view('frontend.privacy-policy', compact('page_seo'));
    }
}
