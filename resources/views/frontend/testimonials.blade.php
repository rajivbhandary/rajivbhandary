@extends('frontend.layouts.app')

@section('title', 'Testimonials | Perks Properties')

@section('seo-author', $config->default_seo_author)

@section('seo-description'){{ $page_seo->seo_description ?? $config->default_seo_description }}@endsection

@section('seo-keywords'){{ $config->default_seo_keywords . ($page_seo->seo_keywords ? ", $page_seo->seo_keywords" : '') }}@endsection

@section('seo-og-title'){{ $page_seo->seo_og_title ?? $config->default_seo_og_title }}@endsection

@section('seo-og-description'){{ $page_seo->seo_og_description ?? $config->default_seo_og_description }}@endsection

@section('main-content')

    <!-- Bread-crumbs -->
    @include('frontend.layouts.testimonials._bread-crumb')  

    <!-- Company Introduction -->
    @include('frontend.layouts.testimonials._testimonials')

@endsection