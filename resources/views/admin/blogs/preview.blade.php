@extends('frontend.layouts.app')

@section('seo-author', $config->default_seo_author)

@section('seo-description'){{ $page_seo->seo_description ?? $config->default_seo_description }}@endsection

@section('seo-keywords'){{ $config->default_seo_keywords . ($page_seo->seo_keywords ? ", $page_seo->seo_keywords" : '') }}@endsection

@section('seo-og-title'){{ $page_seo->seo_og_title ?? $config->default_seo_og_title }}@endsection

@section('seo-og-description'){{ $page_seo->seo_og_description ?? $config->default_seo_og_description }}@endsection

@section('title', 'Blogs | Perks Properties')

@section('main-content')
    <!-- ========================== Articles Section =============================== -->
    <div id="property-list-hero-section" class="text-center bg-cover mb-10" data-animated-id="2">
        <div class="hero-section-overlay">
            <div class="container py-15 ">
                <div data-animate="fadeInDown" class="fadeInDown animated">
                <h2 class="fs-md-42 text-white pt-5"><span class="fs-md-52 font-weight-bold text-white pt-2 d-block">
                    Blogs
                </span>
                </h2>
                    <p class="lead font-weight-light"><a href="{{route('frontend.index')}}" class="text-gray">Home&nbsp;/</a> 
                    <a href="{{ route('blogs.preview')}}" class="text-white">Blogs</a></p>
                </div>
            </div>
        </div>
    </div>
    <section class="pt-8 pb-8">
        <div class="container">
            <div class="position-relative z-index-2 mb-8">
                <div class="position-relative">
                    <input class="search-field" type="hidden" name="status" value="blog-search" data-default-value="">
                    <form class="d-flex">
                        <div class="position-relative w-100"> <i class="fa fa-search text-dark fs-18 position-absolute pl-4 pos-fixed-left-center"></i>
                            <input type="search" class="rounded-bottom-right-lg w-100 pl-8 py-4 bg-white border fs-13 font-weight-500 text-gray-light rounded-0 lh-17" placeholder="Search..." name="search" value="{{ request('search') }}" aria-label="Search"> </div>
                        <button class="btn btn-primary fs-16 font-weight-600 rounded-left-0 rounded-lg"> Search </button>
                    </form>
                    </div>         
            </div>
            <div class="row">

            @foreach($blogs as $blog)
                <!-- Single Article -->
                <div class="col-md-4 mb-6">
                    <div class="ribbon ribbon-top-right">
                        <span class="{{ $blog->isApproved()?'ribbon-light':'ribbon-dark text-long' }}">
                            {{ $blog->isApproved()?'visible':'invisible' }}
                        </span>
                    </div>
                    <div class="card border-0 shadow-xxs-3">
                    <div class="position-relative d-flex align-items-end card-img-top">
                        <a href="{{ route('blogs.single-blog-preview', $blog->slug) }}" class="hover-shine">
                        <img src="{{asset("storage/{$blog->image}")}}" width="100%" alt="{{ $blog->title }}">
                        </a>
                    </div>
                    <div class="card-body px-5 pt-3 pb-5">
                        <h3 class="fs-18 text-heading lh-194 mb-1">
                            <a href="{{  route('blogs.single-blog-preview', $blog->slug) }}" class="text-heading hover-primary">{{ $blog->title }}</a>
                        </h3>
                        <div class="d-flex justify-content-between text-gray align-items-center">
                            <div>{{ $blog->author->name }}</div>    
                            <div>{{ explode(' ', $blog->published_at)[0] }}</div>                                      
                        </div>
                        <p class="mb-3 text-gray">{{ $blog->excerpt }}</p>
                        <a class="text-heading font-weight-500" href="{{ route('blogs.single-blog-preview', $blog->slug) }}">Learn more <i class=" fa fa-long-arrow-right text-primary ml-1"></i></a>
                    </div>
                    </div>
                </div>

                @endforeach
            </div>

            {{ $blogs->appends(['search' => request('search')])->links() }}

        </div>
    </section>
    <!-- ========================== Articles Section =============================== -->
@endsection

@section('page-level-styles')
    <link rel="stylesheet" href="{{asset('assets/admin/css/ribbons.css')}}">
@endsection