@extends('frontend.layouts.app')

@section('title', 'About us | Perks Properties, Mumbai & Thane since 1999')
@section('seo-description'){{ optional($page_seo)->seo_description ?: 'Perks Properties has helped clients buy, sell, rent and invest in property in Mumbai and Thane since 1999, with offices in Colaba and Thane.' }}
@endsection

@section('main-content')
    @include('frontend.layouts.shared._page-hero', [
        'title' => 'About Perks Properties',
        'subtitle' => 'Property advisors in Mumbai and Thane since 1999.',
    ])

    <section class="pp-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="pp-eyebrow">Our story</span>
                    <h2 class="pp-section__title">Local knowledge, from the building up</h2>
                    <p class="mt-4">Perks Properties was established in 1999 with a background in facility management. Looking after buildings taught us what makes a property a good buy or a good tenancy, and that experience still shapes how we advise clients today.</p>
                    <p>We help people buy, sell, rent and invest in every kind of property, residential or commercial, resale or new projects. Our network across Mumbai and Thane helps us find the right opportunity for each client.</p>
                    <p class="mb-0">You can meet us at our offices in Colaba and Thane, or start with a call.</p>
                </div>
                <div class="col-lg-5 mt-6 mt-lg-0">
                    <img src="{{ asset('assets/frontend/img/about-us/about-us.svg') }}" alt="" class="w-100" style="max-width:460px" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <section class="pp-section pp-section--tint" aria-labelledby="leadership-title">
        <div class="container">
            <span class="pp-eyebrow">Leadership</span>
            <h2 class="pp-section__title mb-6" id="leadership-title">The people behind Perks</h2>
            <div class="pp-cols-2" style="max-width:760px">
                <div class="pp-office text-center">
                    <img src="{{ asset('assets/frontend/img/testimonials/user.png') }}" alt="Ashok Bhandari" class="rounded-circle mb-3" width="112" height="112" loading="lazy">
                    <h3>Ashok Bhandari</h3>
                    <p class="text-muted mb-0">Managing Director</p>
                </div>
                <div class="pp-office text-center">
                    <img src="{{ asset('assets/frontend/img/about-us/director-336.jpg') }}" alt="Akash Bhandary" class="rounded-circle mb-3" width="112" height="112" style="object-fit:cover" loading="lazy">
                    <h3>Akash Bhandary</h3>
                    <p class="text-muted mb-0">Director</p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layouts._service-provided-section')

    <div class="pt-10">
        @include('frontend.layouts.shared._cta-band')
    </div>
@endsection
