<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Page::create([
           'route_name' => 'frontend.index',
           'route_url' => url('/'),
            'seo_og_title' => 'Home | Perks Properties',
        ]);

        \App\Page::create([
            'route_name' => 'frontend.blogs',
            'route_url' => url('/blogs'),
            'seo_og_title' => 'Blogs | Perks Properties',
        ]);

        \App\Page::create([
            'route_name' => 'frontend.properties',
            'route_url' => url('/property-list'),
            'seo_og_title' => 'Properties | Perks Properties',
        ]);

        \App\Page::create([
            'route_name' => 'frontend.testimonials',
            'route_url' => url('/testimonials-list'),
            'seo_og_title' => 'Testimonials | Perks Properties',
        ]);

        \App\Page::create([
        'route_name' => 'frontend.contact-us',
            'route_url' => url('/contact-us'),
            'seo_og_title' => 'Contact Us | Perks Properties',
        ]);

        \App\Page::create([
            'route_name' => 'frontend.about-us',
            'route_url' => url('/about-us'),
            'seo_og_title' => 'About Us | Perks Properties',
        ]);

        \App\Page::create([
            'route_name' => 'blogs.preview',
            'route_url' => url('/control-panel/blogs/preview'),
            'seo_og_title' => 'Blogs | Perks Properties',
         ]);

        \App\Page::create([
            'route_name' => 'frontend.fre',
            'route_url' => url('/fre-list'),
            'seo_og_title' => 'FRE | Perks Properties',
        ]);

        \App\Page::create([
            'route_name' => 'frontend.advance-search',
            'route_url' => url('/advance-search'),
            'seo_og_title' => 'Properties | Perks Properties',
        ]);

    }
}
