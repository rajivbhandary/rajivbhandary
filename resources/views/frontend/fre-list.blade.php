@extends('frontend.layouts.app')

@section('title'){{ "FREs | Perks Properties" }}@endsection

@section('seo-author', $config->default_seo_author)

@section('seo-description'){{ $page_seo->seo_description ?? $config->default_seo_description }}@endsection

@section('seo-keywords'){{ $config->default_seo_keywords . ($page_seo->seo_keywords ? ", $page_seo->seo_keywords" : '') }}@endsection

@section('seo-og-title'){{ $page_seo->seo_og_title ?? $config->default_seo_og_title }}@endsection

@section('seo-og-description'){{ $page_seo->seo_og_description ?? $config->default_seo_og_description }}@endsection


@section('main-content')

    @include('frontend.layouts.fre-list._fre-list-bread-crumb')

    @include('frontend.layouts.fre-list._fractional-ownership')

    @include('frontend.layouts.fre-list._fre-list-card')

@endsection

@section('title', 'Property List')
