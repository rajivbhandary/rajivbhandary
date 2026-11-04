@extends('frontend.layouts.app')

@section('title', 'Fractional ownership of commercial property | Perks Properties')
@section('seo-description'){{ optional($page_seo)->seo_description ?: 'Own a share of leased commercial property in Mumbai and Thane, such as offices and warehouses, with rental income and expert management.' }}@endsection

@section('main-content')
    @include('frontend.layouts.shared._page-hero', [
        'title' => 'Fractional ownership',
        'subtitle' => 'Own a share of a leased office, shop or warehouse and earn your part of the rent, without buying the whole property.',
    ])

    <section class="pp-section">
        <div class="container">
            <div class="pp-section__head">
                <div>
                    <span class="pp-eyebrow">How it works</span>
                    <h2 class="pp-section__title">Commercial property, in smaller pieces</h2>
                </div>
            </div>
            <div class="pp-cols-2">
                <div class="pp-feature"><span class="pp-feature__icon">1</span><div><h3>Rental income</h3><p>Leased properties pay rent to owners in proportion to their share. Target yields for each listing are shown below.</p></div></div>
                <div class="pp-feature"><span class="pp-feature__icon">2</span><div><h3>Smaller ticket size</h3><p>Invest from the minimum amount listed for each property instead of buying a whole floor or warehouse.</p></div></div>
                <div class="pp-feature"><span class="pp-feature__icon">3</span><div><h3>Spread your money</h3><p>Hold shares in different kinds of property, such as offices, retail and warehousing, to spread risk.</p></div></div>
                <div class="pp-feature"><span class="pp-feature__icon">4</span><div><h3>Managed for you</h3><p>Rent collection and tenant management are handled for owners. Exit options depend on each offer; ask us before you invest.</p></div></div>
            </div>
        </div>
    </section>

    <section class="pp-section pp-section--tint" aria-labelledby="fre-returns">
        <div class="container">
            <h2 class="pp-section__title" id="fre-returns">Typical annual returns compared<a href="#investment-disclaimer" aria-label="See note">*</a></h2>
            <p class="pp-section__lead">Indicative figures for comparison only, not a forecast for any listing.</p>
            <dl class="pp-keyfacts mt-5" style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr))">
                @foreach (['Fractional real estate' => '14.7%', 'Equity' => '12.05%', 'Debt mutual funds' => '7.5%', 'PPF' => '7–8%', 'Bank FD' => '6–8%'] as $label => $value)
                    <div class="pp-panel mb-0"><dt class="text-muted small text-uppercase">{{ $label }}</dt><dd class="h4 mb-0 mt-1">{{ $value }}</dd></div>
                @endforeach
            </dl>
            <div class="mt-4">@include('frontend.layouts.shared._investment-disclaimer')</div>
        </div>
    </section>

    <section class="pp-section" aria-labelledby="fre-list-title">
        <div class="container">
            <div class="pp-section__head">
                <div>
                    <span class="pp-eyebrow">{{ $fre_count }} {{ \Illuminate\Support\Str::plural('opportunity', $fre_count) }}</span>
                    <h2 class="pp-section__title" id="fre-list-title">Current offers</h2>
                </div>
            </div>
            @if ($fre_count)
                <div class="pp-grid">
                    @foreach ($fres as $fre)
                        @include('frontend.layouts.shared._fre-card', ['fre' => $fre])
                    @endforeach
                </div>
                {{ $fres->links() }}
            @else
                <div class="pp-empty"><h2>No open offers right now</h2><p class="text-muted">Leave your number and we will tell you when the next one opens.</p>
                    <button type="button" class="pp-btn pp-btn--primary" data-toggle="modal" data-target="#enquiryModal" data-enquire>Notify me</button></div>
            @endif
        </div>
    </section>

    @include('frontend.layouts.shared._cta-band')
@endsection
