@extends('frontend.layouts.app')

@section('title'){{ "$blog->title | Perks Properties" }}@endsection
@section('seo-author', $config->default_seo_author)

@section('seo-description'){{ $blog->seo_description ?? $config->default_seo_description }}@endsection

@section('seo-keywords'){{ $config->default_seo_keywords . ($blog->seo_keywords ? ", $blog->seo_keywords" : '') }}@endsection

@section('seo-og-title'){{ $blog->seo_og_title ?? $config->default_seo_og_title }}@endsection

@section('seo-og-description'){{ $blog->seo_og_description ?? $config->default_seo_og_description }}@endsection


@section('main-content')
    @include('frontend.layouts.single-blog._bread-crumb')
    <div class="primary-content bg-gray-01 pt-7 pb-12" data-animated-id="3">
        <div class="container">
            <div class="row">
                <article class="col-lg-8">
                    <!-- Description -->
                    @include('frontend.layouts.single-blog._description')
                </article>

                <aside class="col-lg-4 pl-xl-4 primary-sidebar sidebar-sticky" id="sidebar">
                    <!-- sidebar-->
                    @include('frontend.layouts.single-blog._sidebar')
                </aside>
        	</div>
        </div>
    </div>

@endsection