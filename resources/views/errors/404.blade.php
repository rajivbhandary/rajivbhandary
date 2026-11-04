@extends('frontend.layouts.app')

@section('title', 'Page not found | Perks Properties')
@section('robots', 'noindex')

@section('main-content')
    <section class="pp-section">
        <div class="container text-center" style="max-width:720px">
            <span class="pp-eyebrow">Error 404</span>
            <h1 class="pp-section__title">We couldn’t find that page</h1>
            <p class="pp-section__lead mx-auto">The listing may have been sold or rented, or the link may be out of date. Try a search instead.</p>
            <div class="text-left mt-6">
                @include('frontend.layouts.shared._search-form', ['id' => 'notfound-search'])
            </div>
            <p class="mt-6"><a href="{{ route('frontend.index') }}">Go to the homepage</a> &middot; <a href="{{ route('frontend.contact-us') }}">Contact us</a></p>
        </div>
    </section>
@endsection
