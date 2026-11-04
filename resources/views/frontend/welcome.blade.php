@extends('frontend.layouts.app')

@section('title', 'Perks Properties | Buy, rent and invest in property in Mumbai & Thane')
@section('seo-description'){{ optional($page_seo)->seo_description ?: 'Flats, offices, shops and land to buy or rent in Mumbai and Thane, plus fractional ownership of commercial property. Property advisors since 1999.' }}@endsection
@section('seo-og-title'){{ optional($page_seo)->seo_og_title ?: 'Perks Properties' }}@endsection
@section('seo-og-description'){{ optional($page_seo)->seo_og_description }}@endsection

@section('main-content')
    @include('frontend.layouts._hero-section')

    @if ($properties->count() > 0)
        @include('frontend.layouts._popular-properties-section')
    @endif

    @include('frontend.layouts._service-provided-section')

    @include('frontend.layouts._about-our-company-section')

    @if ($testimonials->count() > 0)
        @include('frontend.layouts._testimonial-section')
    @endif

    @if ($blogs->count() > 0)
        @include('frontend.layouts._blog-section')
    @endif

    @include('frontend.layouts.shared._cta-band')
@endsection
