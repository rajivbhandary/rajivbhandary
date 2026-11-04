@extends('frontend.layouts.app')

@section('title', 'Client stories | Perks Properties')
@section('seo-description'){{ optional($page_seo)->seo_description ?: 'What buyers, sellers, tenants and landlords say about working with Perks Properties in Mumbai and Thane.' }}
@endsection

@section('main-content')
    @include('frontend.layouts.shared._page-hero', [
        'title' => 'Client stories',
        'subtitle' => 'In their own words: people we have helped buy, sell, rent and invest.',
    ])

    <section class="pp-section">
        <div class="container">
            <div class="pp-cols-3">
                @foreach ($testimonials as $testimonial)
                    @include('frontend.layouts.shared._testimonial', ['testimonial' => $testimonial])
                @endforeach
            </div>
            {{ $testimonials->links() }}
        </div>
    </section>

    @include('frontend.layouts.shared._cta-band')
@endsection
