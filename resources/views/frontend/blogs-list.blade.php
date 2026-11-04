@extends('frontend.layouts.app')

@php
    $tagName = isset($tag) ? $tag->name : null;
    $heading = $tagName ? 'Articles about ' . $tagName : 'Property advice and news';
@endphp

@section('title'){{ $heading }} | Perks Properties Blog
@endsection
@section('seo-description'){{ optional($page_seo)->seo_description ?: 'Guides for buying, selling, renting and investing in property in Mumbai and Thane, from the Perks Properties team.' }}
@endsection
@if (request('search'))
    @section('robots', 'noindex, follow')
@endif

@section('main-content')
    @include('frontend.layouts.shared._page-hero', [
        'title' => $heading,
        'crumbs' => $tagName ? [['label' => 'Blog', 'url' => route('frontend.blogs')]] : [],
    ])

    <section class="pp-section pt-6">
        <div class="container">
            <form class="pp-toolbar mt-0" action="{{ url()->current() }}" method="GET" role="search">
                <p role="status">
                    @if ($blog_count)
                        <strong>{{ $blog_count }}</strong> {{ \Illuminate\Support\Str::plural('article', $blog_count) }}@if(request('search')) matching “{{ request('search') }}”@endif
                    @else
                        No articles found
                    @endif
                </p>
                <div class="pp-field">
                    <label for="blog-search" class="sr-only">Search articles</label>
                    <input type="search" id="blog-search" name="search" value="{{ request('search') }}" placeholder="Search articles" style="min-height:42px">
                    <button type="submit" class="pp-btn pp-btn--navy pp-btn--sm">Search</button>
                </div>
            </form>

            @if ($blog_count)
                <div class="pp-cols-3">
                    @foreach ($blogs as $blog)
                        @include('frontend.layouts.shared._blog-card', ['blog' => $blog])
                    @endforeach
                </div>
                {{ $blogs->withQueryString()->links() }}
            @else
                <div class="pp-empty"><h2>Nothing here yet</h2><p class="text-muted mb-0"><a href="{{ route('frontend.blogs') }}">See all articles</a></p></div>
            @endif
        </div>
    </section>
@endsection
