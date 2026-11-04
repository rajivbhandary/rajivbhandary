@extends('frontend.layouts.app')

@php
    $location = $fre->location;
    $place = collect([optional($location)->locality, optional($location)->town, optional($location)->city])->filter()->unique()->implode(', ');
    $minDigits = preg_replace('/[^\d.]/', '', (string) $fre->minimum_investment);
    $minInvestment = is_numeric($minDigits) ? \App\Support\Format::inr($minDigits) : $fre->minimum_investment;
    $photos = collect([$fre->feature_image_path])
        ->merge($fre->image->map(function ($item) { return optional($item->image)->path; }))
        ->filter()->unique()->values();
    $summary = \App\Support\Html::text($fre->overview);
    $waText = 'Hi Perks Properties, I would like details of the fractional offer "' . $fre->title . '": ' . url()->current();
    $pct = function ($v) { return $v !== null && $v !== '' ? rtrim(rtrim(number_format((float) $v, 2), '0'), '.') . '%' : null; };

    $investment = array_filter([
        'Minimum investment' => $minInvestment,
        'Total property value' => \App\Support\Format::inr($fre->total_price),
        'Rental yield' => $pct($fre->rental_yield),
        'Gross yield' => $pct($fre->gross_yield),
        'Expected IRR' => $pct($fre->expected_irr),
        'Target multiplier' => $fre->target_multiplier ? $fre->target_multiplier . 'x' : null,
    ]);
    $building = array_filter([
        'Property type' => $fre->property_type,
        'Commercial space' => $fre->commercial_space,
        'Built-up area' => $fre->built_up_area ? \App\Support\Format::grouped($fre->built_up_area) . ' sq ft' : null,
        'Carpet area' => $fre->carpet_area ? \App\Support\Format::grouped($fre->carpet_area) . ' sq ft' : null,
        'Floor plate' => $fre->floor_plate ? \App\Support\Format::grouped($fre->floor_plate) . ' sq ft' : null,
        'Floor' => $fre->floor,
        'Car parking' => $fre->car_parking,
        'Lifts' => $fre->elevators,
        'Possession' => $fre->possesion_date ? \Carbon\Carbon::parse($fre->possesion_date)->format('M Y') : null,
        'RERA number' => $fre->rera_number,
    ]);
    $tenant = array_filter([
        'Industry' => $fre->industry,
        'Founded' => $fre->founded,
        'Employees' => $fre->employees ? \App\Support\Format::grouped($fre->employees) : null,
        'Market cap' => $fre->market_cap,
    ]);
@endphp

@section('title'){{ $fre->title }} - fractional ownership | Perks Properties
@endsection
@section('seo-description'){{ $fre->seo_description ?: \Illuminate\Support\Str::limit('Own a share from ' . $minInvestment . '. ' . $summary, 155) }}
@endsection
@section('seo-og-title'){{ $fre->seo_og_title ?: $fre->title }}
@endsection
@section('seo-og-description'){{ $fre->seo_og_description ?: \Illuminate\Support\Str::limit($summary, 190) }}
@endsection
@section('og-image'){{ asset('storage/' . $fre->feature_image_path) }}
@endsection
@section('body-class', 'has-cta-bar')

@section('main-content')
<div class="pp-detail">
    <div class="container">
        <nav aria-label="Breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.fre') }}">Fractional ownership</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $fre->title }}</li>
            </ol>
        </nav>

        <div class="pp-detail__head">
            <div>
                <span class="pp-badge pp-badge--rent">Fractional ownership</span>
                <h1 class="pp-detail__title">{{ $fre->title }}</h1>
                <p class="pp-detail__place"><i class="fa fa-map-marker text-danger mr-1" aria-hidden="true"></i>{{ $place }}@if($fre->developer) &middot; by {{ $fre->developer->name }}@endif</p>
            </div>
            <p class="pp-detail__price">From {{ $minInvestment }}<small>minimum investment</small></p>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="pp-gallery" data-gallery>
                    <div class="pp-gallery__main">
                        <img data-gallery-main src="{{ asset('storage/' . $photos->first()) }}" alt="{{ $fre->title }}, photo 1" width="1200" height="750">
                    </div>
                    @if ($photos->count() > 1)
                        <div class="pp-gallery__thumbs">
                            @foreach ($photos as $i => $photo)
                                <button type="button" data-gallery-thumb data-src="{{ asset('storage/' . $photo) }}" @if($i === 0) aria-current="true" @endif aria-label="Show photo {{ $i + 1 }}">
                                    <img src="{{ asset('storage/' . $photo) }}" alt="{{ $fre->title }}, photo {{ $i + 1 }}" loading="lazy" width="200" height="150">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <section class="pp-panel" aria-labelledby="fre-overview">
                    <h2 id="fre-overview">Overview</h2>
                    <div class="pp-prose">{!! nl2br(e($fre->overview)) !!}</div>
                    @if ($fre->overviewKeypoints->count())
                        <ul class="pp-chips mt-4">
                            @foreach ($fre->overviewKeypoints as $point)
                                <li><i class="fa fa-check" aria-hidden="true"></i>{{ $point->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </section>

                <section class="pp-panel" aria-labelledby="fre-investment">
                    <h2 id="fre-investment">Investment</h2>
                    <dl class="pp-specs">
                        @foreach ($investment as $label => $value)<div><dt>{{ $label }}</dt><dd>{{ $value }}</dd></div>@endforeach
                    </dl>
                    <div class="mt-4">@include('frontend.layouts.shared._investment-disclaimer')</div>
                </section>

                <section class="pp-panel" aria-labelledby="fre-building">
                    <h2 id="fre-building">The property</h2>
                    <dl class="pp-specs">
                        @foreach ($building as $label => $value)<div><dt>{{ $label }}</dt><dd>{{ $value }}</dd></div>@endforeach
                    </dl>
                    @if ($fre->details_info)<p class="mt-4 mb-0">{{ $fre->details_info }}</p>@endif
                </section>

                @if ($fre->tenant_overview || $tenant)
                    <section class="pp-panel" aria-labelledby="fre-tenant">
                        <h2 id="fre-tenant">The tenant</h2>
                        @if ($fre->tenant_overview)<p>{{ $fre->tenant_overview }}</p>@endif
                        @if ($tenant)
                            <dl class="pp-specs">
                                @foreach ($tenant as $label => $value)<div><dt>{{ $label }}</dt><dd>{{ $value }}</dd></div>@endforeach
                            </dl>
                        @endif
                    </section>
                @endif

                @if ($fre->developer && $fre->developer->info)
                    <section class="pp-panel" aria-labelledby="fre-developer">
                        <h2 id="fre-developer">About {{ $fre->developer->name }}</h2>
                        <p class="mb-0">{{ $fre->developer->info }}</p>
                    </section>
                @endif

                @if ($fre->amenity->count() || $fre->surroundings->count())
                    <section class="pp-panel" aria-labelledby="fre-around">
                        <h2 id="fre-around">Amenities and nearby</h2>
                        <ul class="pp-chips">
                            @foreach ($fre->amenity->toBase()->concat($fre->surroundings) as $item)
                                <li><i class="fa fa-check" aria-hidden="true"></i>{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                <section class="pp-panel" aria-labelledby="fre-map">
                    <h2 id="fre-map">Location</h2>
                    @include('frontend.layouts._map', ['lat' => optional($location)->latitude, 'lng' => optional($location)->longitude, 'label' => $fre->title])
                </section>
            </div>

            <aside class="col-lg-4" aria-label="Ask about this offer">
                <div class="pp-panel pp-contact-card">
                    <p class="text-muted mb-1">Minimum investment</p>
                    <p class="pp-contact-card__price">{{ $minInvestment }}</p>
                    @if ($pct($fre->rental_yield))<p class="mb-0">Rental yield <strong>{{ $pct($fre->rental_yield) }}</strong></p>@endif
                    <hr>
                    @if ($config->phone_href)
                        <a class="pp-btn pp-btn--navy pp-btn--block" href="tel:{{ $config->phone_href }}"><i class="fa fa-phone" aria-hidden="true"></i> Call {{ $config->phone_display }}</a>
                    @endif
                    @if ($config->whatsappUrl())
                        <a class="pp-btn pp-btn--whatsapp pp-btn--block" href="{{ $config->whatsappUrl($waText) }}" target="_blank" rel="noopener"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</a>
                    @endif
                    <button type="button" class="pp-btn pp-btn--primary pp-btn--block" data-toggle="modal" data-target="#enquiryModal"
                            data-enquire data-model="fre" data-id="{{ $fre->id }}" data-title="{{ $fre->title }}">Get the offer details</button>
                </div>
            </aside>
        </div>

        @if ($latest_fre->count())
            <section class="mt-8" aria-labelledby="more-fre">
                <h2 class="pp-section__title mb-5" id="more-fre">More fractional offers</h2>
                <div class="pp-grid">
                    @foreach ($latest_fre as $other)
                        @include('frontend.layouts.shared._fre-card', ['fre' => $other])
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
@endsection

@section('cta-bar')
<div class="pp-cta-bar" role="region" aria-label="Ask about this offer">
    @if ($config->phone_href)
        <a class="pp-btn pp-btn--navy" href="tel:{{ $config->phone_href }}"><i class="fa fa-phone" aria-hidden="true"></i> Call</a>
    @endif
    @if ($config->whatsappUrl())
        <a class="pp-btn pp-btn--whatsapp" href="{{ $config->whatsappUrl($waText) }}" target="_blank" rel="noopener"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</a>
    @endif
    <button type="button" class="pp-btn pp-btn--primary" data-toggle="modal" data-target="#enquiryModal"
            data-enquire data-model="fre" data-id="{{ $fre->id }}" data-title="{{ $fre->title }}">Get details</button>
</div>
@endsection
