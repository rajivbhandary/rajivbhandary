<?php

namespace Tests\Feature;

use App\Blog;
use App\Property;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PublicSiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\ConfigSeeder::class);
        $this->seed(\PageSeeder::class);
        $this->seed(\TestimonialSeeder::class);
        $this->seed(\FRESeeder::class);
        $this->seed(\PropertySeeder::class);
    }

    public function test_every_public_page_renders()
    {
        $property = Property::first();
        $fre = \App\FRE::first();

        foreach (['/', '/properties-list', '/properties/' . $property->slug, '/fre-list', '/fre/' . $fre->slug,
                  '/blogs', '/testimonials', '/about-us', '/contact-us', '/privacy-policy', '/sitemap.xml'] as $url) {
            $this->get($url)->assertOk();
        }
        $this->get('/property-list')->assertRedirect('/properties-list');
        $this->get('/properties/no-such-listing')->assertNotFound();
    }

    public function test_keyword_search_respects_buy_or_rent()
    {
        $sale = Property::where('status', 'Sell')->count();
        $rent = Property::where('status', 'Rent')->count();
        $this->assertGreaterThan(0, $sale);
        $this->assertGreaterThan(0, $rent);

        $this->get('/advance-search?status=for-buy&search=Mulund')
            ->assertOk()
            ->assertViewHas('property_count', $sale);
        $this->get('/advance-search?status=for-rent&search=Mulund')
            ->assertOk()
            ->assertViewHas('property_count', $rent);
    }

    public function test_search_never_returns_deleted_listings()
    {
        Property::where('status', 'Sell')->first()->delete();

        $this->get('/advance-search?status=for-buy&search=Mulund')
            ->assertViewHas('property_count', Property::where('status', 'Sell')->count());
        $this->get('/advance-search?search=Mulund')
            ->assertViewHas('property_count', Property::count());
    }

    public function test_search_results_can_be_shared_and_paginated()
    {
        $response = $this->get('/advance-search?status=for-rent&type=commercial&subtype=offices&page=1');
        $response->assertOk();
        $this->assertSame(1, $response->viewData('properties')->total());
    }

    public function test_budget_filter_uses_rent_for_rentals_and_price_for_sales()
    {
        // Seeded rents: 10,000 / 10,00,000 / 5,00,000 / 25,000.
        $this->get('/advance-search?status=for-rent&max_price=50000')->assertViewHas('property_count', 2);
        // Seeded sale prices: 2.5 Cr and three at 2.1 L.
        $this->get('/advance-search?status=for-buy&min_price=10000000')->assertViewHas('property_count', 1);
    }

    public function test_prices_are_shown_in_lakh_and_crore()
    {
        $this->get('/properties-list')
            ->assertSee('₹2.5 Cr')
            ->assertSee('₹10 L / month')
            ->assertSee('₹25,000 / month');
    }

    public function test_tag_pages_hide_unapproved_and_unpublished_posts()
    {
        $author = factory(User::class)->create();
        $tag = Tag::create(['name' => 'Home loans', 'slug' => 'home-loans']);
        $draft = Blog::create([
            'user_id' => $author->id, 'title' => 'Secret draft post', 'slug' => 'secret-draft-post',
            'excerpt' => 'x', 'body' => '<p>x</p>', 'image' => 'blogs/x.jpg',
        ]);
        $draft->tags()->attach($tag->id);

        $this->get('/blogs/tag/home-loans')->assertOk()->assertDontSee('Secret draft post');
        $this->get('/blogs/secret-draft-post')->assertNotFound();
    }

    public function test_listing_pages_show_one_main_heading_and_no_placeholder_text()
    {
        foreach (['/', '/about-us', '/properties-list'] as $url) {
            $html = $this->get($url)->getContent();
            $this->assertSame(1, substr_count($html, '<h1'), "$url should have exactly one h1");
            $this->assertStringNotContainsStringIgnoringCase('lorem ipsum dolor sit amet, consec tetur', $html);
            $this->assertStringNotContainsString('(+68)', $html);
        }
    }

    public function test_furnishing_and_office_flags_are_displayed_correctly()
    {
        $residential = Property::where('type', 'Residential')->with('residential')->first();
        DB::table('residentials')->where('property_id', $residential->id)->update(['furnishing' => 1]);

        $this->get('/properties/' . $residential->slug)->assertSee('Furnished')->assertDontSee('Unfurnished');
    }
}
