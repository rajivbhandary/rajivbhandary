@extends('frontend.layouts.app')

@section('seo-author', $config->default_seo_author)

@section('seo-description'){{ $page_seo->seo_description ?? $config->default_seo_description }}@endsection

@section('seo-keywords'){{ $config->default_seo_keywords . ($page_seo->seo_keywords ? ", $page_seo->seo_keywords" : '') }}@endsection

@section('seo-og-title'){{ $page_seo->seo_og_title ?? $config->default_seo_og_title }}@endsection

@section('seo-og-description'){{ $page_seo->seo_og_description ?? $config->default_seo_og_description }}@endsection

@section('main-content')
        @include('frontend.layouts._hero-section')

        @if($properties->count() > 0)
                @include('frontend.layouts._popular-properties-section')
        @endif

        @include('frontend.layouts._about-our-company-section')

        @include('frontend.layouts._service-provided-section')
        
        @if($testimonials->count() > 0)
                @include('frontend.layouts._testimonial-section')
        @endif

        @if($blogs->count() > 0)
                @include('frontend.layouts._blog-section')
        @endif
@endsection

@section('title', "Home | Perks Properties")

@section('page-level-scripts')
        <script src="{{asset('assets/frontend/js/welcome.js')}}"></script>
@endsection