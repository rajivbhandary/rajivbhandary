<?php

namespace App\Http\Controllers\frontend;

use App\Blog;
use App\FRE;
use App\Http\Controllers\Controller;
use App\Property;

class SitemapController extends Controller
{
    public function index()
    {
        $static = ['frontend.index', 'frontend.properties', 'frontend.fre', 'frontend.blogs',
            'frontend.testimonials', 'frontend.about-us', 'frontend.contact-us', 'frontend.privacy'];

        $urls = collect($static)->map(function ($name) {
            return ['loc' => route($name), 'lastmod' => null];
        });

        foreach (Property::withoutTrashed()->get(['slug', 'updated_at']) as $property) {
            $urls->push(['loc' => route('frontend.single-property', $property->slug), 'lastmod' => $property->updated_at]);
        }
        foreach (FRE::withoutTrashed()->get(['slug', 'updated_at']) as $fre) {
            $urls->push(['loc' => route('frontend.single-fre', $fre->slug), 'lastmod' => $fre->updated_at]);
        }
        foreach (Blog::withoutTrashed()->approved()->published()->get(['slug', 'updated_at']) as $blog) {
            $urls->push(['loc' => route('frontend.single-blog', $blog->slug), 'lastmod' => $blog->updated_at]);
        }

        return response()
            ->view('frontend.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
