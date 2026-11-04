@extends('frontend.layouts.app')

@php
    $isSearch = request()->routeIs('frontend.advance-search');
    $heading = 'Properties for sale and rent';
    if (($filters['status'] ?? null) === 'for-buy') { $heading = 'Properties for sale'; }
    if (($filters['status'] ?? null) === 'for-rent') { $heading = 'Properties for rent'; }
@endphp

@section('title'){{ $heading }} in Mumbai & Thane | Perks Properties
@endsection
@section('seo-description'){{ optional($page_seo)->seo_description ?: 'Browse flats, offices, shops and land for sale or rent in Mumbai and Thane, with prices, carpet area and photos.' }}@endsection
@if ($isSearch)
    {{-- Search result pages are not indexed; the main listings page is. --}}
    @section('robots', 'noindex, follow')
    @section('canonical', route('frontend.properties'))
@endif

@section('main-content')
    @include('frontend.layouts.shared._page-hero', [
        'title' => $heading,
        'subtitle' => 'Homes, offices, shops and land across Mumbai and Thane.',
    ])

    <div class="container">
        <div class="mt-n5 position-relative">
            @include('frontend.layouts.shared._search-form', ['filters' => $filters, 'id' => 'list-search'])
        </div>

        <form class="pp-toolbar" method="GET" action="{{ url()->current() }}">
            @foreach (request()->except(['sort', 'page']) as $key => $value)
                @if (is_scalar($value))
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach
            <p role="status">
                @if ($property_count === 0)
                    No properties match your search
                @else
                    Showing <strong>{{ $properties->firstItem() }}–{{ $properties->lastItem() }}</strong> of <strong>{{ $property_count }}</strong> {{ \Illuminate\Support\Str::plural('property', $property_count) }}
                @endif
            </p>
            @if ($property_count > 1)
                <div class="pp-field">
                    <label for="sort">Sort by</label>
                    <select id="sort" name="sort" data-autosubmit>
                        <option value="">Newest first</option>
                        <option value="price-low" @if(request('sort') === 'price-low') selected @endif>Price: low to high</option>
                        <option value="price-high" @if(request('sort') === 'price-high') selected @endif>Price: high to low</option>
                    </select>
                    <button type="submit" class="pp-btn pp-btn--outline pp-btn--sm" data-autosubmit-fallback>Apply</button>
                </div>
            @endif
        </form>

        @if ($property_count === 0)
            <div class="pp-empty mb-10">
                <h2>Nothing matches yet</h2>
                <p class="text-muted">Try a wider budget or a nearby area, or tell us what you need and we will look for you.</p>
                <div class="d-flex justify-content-center flex-wrap" style="gap:10px">
                    <a href="{{ route('frontend.properties') }}" class="pp-btn pp-btn--outline">See all properties</a>
                    <button type="button" class="pp-btn pp-btn--primary" data-toggle="modal" data-target="#enquiryModal" data-enquire>Ask an advisor</button>
                </div>
            </div>
        @else
            <div class="pp-grid">
                @foreach ($properties as $property)
                    @include('frontend.layouts.shared._property-card', ['property' => $property])
                @endforeach
            </div>
            {{ $properties->onEachSide(1)->links() }}
        @endif
    </div>

    <div class="mt-10">
        @include('frontend.layouts.shared._cta-band')
    </div>
@endsection
