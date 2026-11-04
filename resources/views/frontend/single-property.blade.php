@extends('frontend.layouts.app')

@php
    $location = $property->location;
    $rent = $property->isRent() ? $property->rentDetail : null;
    $residential = $property->isResidential() ? $property->residential : null;
    $office = $property->isOffice() ? $property->getOffice() : null;
    $shop = $property->isShop() ? $property->getShop() : null;
    $other = $property->isOtherCommercial() ? $property->getOtherCommercials() : null;
    $yesNo = function ($value) { return $value ? 'Yes' : 'No'; };
    $furnished = function ($value) { return $value ? 'Furnished' : 'Unfurnished'; };
    $floor = function ($n) { return (string) $n === '0' ? 'Ground' : $n; };

    $name = optional($location)->building_name ?: $property->headline;
    $place = collect([optional($location)->locality, optional($location)->town, optional($location)->city])->filter()->unique()->implode(', ');
    $photos = collect([$property->feature_image_path])
        ->merge($property->image->map(function ($item) { return optional($item->image)->path; }))
        ->filter()->unique()->values();
    $summary = \App\Support\Html::text($property->description);
    $waText = 'Hi Perks Properties, I am interested in ' . $name . ' (' . $property->price_label . '): ' . url()->current();

    $specs = array_filter([
        'Listing' => $property->isRent() ? 'For rent' : 'For sale',
        'Property type' => trim($property->type . ($property->detailed_type ? ' · ' . $property->detailed_type : '')),
        'Carpet area' => $property->carpet ? \App\Support\Format::grouped($property->carpet) . ' sq ft' : null,
        'Built-up area' => $property->built_up ? \App\Support\Format::grouped($property->built_up) . ' sq ft' : null,
        'Super built-up area' => $property->super_built_up ? \App\Support\Format::grouped($property->super_built_up) . ' sq ft' : null,
        'Floor' => $property->floor_number !== null ? $floor($property->floor_number) . ($property->total_floors ? ' of ' . $property->total_floors : '') : null,
        'Bathrooms' => $property->number_of_bathrooms,
        'Year built' => $property->age_of_property !== null ? now()->year - (int) $property->age_of_property : null,
        'Availability' => $property->under_construction ? 'Under construction' . ($property->available_by ? ', ready by ' . \Carbon\Carbon::parse($property->available_by)->format('M Y') : '') : 'Ready to move',
        'Price negotiable' => $yesNo($property->negotiable),
        'RERA number' => $property->rera_number,
        'Monthly rent' => $rent ? \App\Support\Format::inr($rent->amount) : null,
        'Security deposit' => $rent ? ucfirst(strtolower($rent->security_deposit_mode)) : null,
        'Agreement' => $rent && $rent->duration_of_agreement ? $rent->duration_of_agreement . ' months' : null,
        'Notice period' => $rent && $rent->months_of_notice ? $rent->months_of_notice . ' ' . \Illuminate\Support\Str::plural('month', $rent->months_of_notice) : null,
        'Bedrooms' => $residential ? $residential->number_of_bedrooms : null,
        'Separate toilets' => $residential ? $residential->number_of_separate_toilets : null,
        'Furnishing' => $residential ? $furnished($residential->furnishing) : ($other ? $furnished($other->furnishing) : null),
        'Facing' => $residential ? $residential->facing_direction : null,
        'Covered parking' => $residential ? $residential->number_of_covered_parkings : ($other ? $other->number_of_covered_parkings : null),
        'Open parking' => $residential ? $residential->number_of_open_parkings : ($other ? $other->number_of_open_parkings : null),
        'Seats' => $office ? $office->number_of_seats : null,
        'Cabins' => $office ? $office->number_of_cabins : null,
        'Meeting rooms' => $office ? $office->number_of_meeting_rooms : null,
        'Reception area' => $office ? $yesNo($office->reception_area) : null,
        'Pantry' => $office ? $yesNo($office->pantry) : null,
        'Staircase' => $office ? $yesNo($office->staircase) : null,
        'Lift' => $office ? $yesNo($office->lift) : null,
        'Facade width' => $shop ? $shop->facade_width . ' ft' : null,
        'Facade height' => $shop ? $shop->facade_height . ' ft' : null,
    ], function ($v) { return $v !== null && $v !== ''; });

    $chipGroups = array_filter([
        'Amenities' => $property->getAmenities(),
        'Facilities' => $property->getFacilities(),
        'Special rooms' => $property->getSpecialRooms(),
        'Safety' => $property->getSafetyEquipments(),
        'Suitable for' => $property->isShop() ? $property->getsuitableBusiness() : collect(),
        'Nearby' => $property->getSurroundings(),
    ], function ($items) { return count($items) > 0; });
@endphp

@section('title'){{ $name }} - {{ $property->headline }} | Perks Properties
@endsection
@section('seo-description'){{ $property->seo_description ?: \Illuminate\Support\Str::limit($property->headline . ', ' . $property->price_label . '. ' . $summary, 155) }}@endsection
@section('seo-og-title'){{ $property->seo_og_title ?: $name . ' · ' . $property->price_label }}@endsection
@section('seo-og-description'){{ $property->seo_og_description ?: \Illuminate\Support\Str::limit($summary, 190) }}@endsection
@section('og-image'){{ asset('storage/' . $property->feature_image_path) }}@endsection
@section('body-class', 'has-cta-bar')

@section('structured-data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        array_filter([
            '@type' => 'RealEstateListing',
            'name' => $name . ' - ' . $property->headline,
            'url' => url()->current(),
            'image' => $photos->map(function ($p) { return asset('storage/' . $p); })->all(),
            'datePosted' => optional($property->created_at)->toDateString(),
            'description' => \Illuminate\Support\Str::limit($summary, 300),
            'offers' => $property->price_amount ? [
                '@type' => 'Offer',
                'price' => (string) $property->price_amount,
                'priceCurrency' => 'INR',
                'businessFunction' => $property->isRent() ? 'http://purl.org/goodrelations/v1#LeaseOut' : 'http://purl.org/goodrelations/v1#Sell',
            ] : null,
        ]),
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('frontend.index')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Properties', 'item' => route('frontend.properties')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $name],
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}
</script>
@endsection

@section('main-content')
<div class="pp-detail">
    <div class="container">
        <nav aria-label="Breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.properties') }}">Properties</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $name }}</li>
            </ol>
        </nav>

        <div class="pp-detail__head">
            <div>
                <span class="pp-badge pp-badge--{{ $property->isRent() ? 'rent' : 'sale' }}">{{ $property->isRent() ? 'For rent' : 'For sale' }}</span>
                <h1 class="pp-detail__title">{{ $name }}</h1>
                <p class="pp-detail__place"><i class="fa fa-map-marker text-danger mr-1" aria-hidden="true"></i>{{ $property->headline }} &middot; {{ $place }}</p>
            </div>
            <p class="pp-detail__price">
                {{ $property->price_label }}
                @if ($property->negotiable)<small>Negotiable</small>@endif
            </p>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="pp-gallery" data-gallery>
                    <div class="pp-gallery__main">
                        <img data-gallery-main src="{{ asset('storage/' . $photos->first()) }}" alt="{{ $name }}, photo 1" width="1200" height="750">
                    </div>
                    @if ($photos->count() > 1)
                        <div class="pp-gallery__thumbs">
                            @foreach ($photos as $i => $photo)
                                <button type="button" data-gallery-thumb data-src="{{ asset('storage/' . $photo) }}" @if($i === 0) aria-current="true" @endif aria-label="Show photo {{ $i + 1 }}">
                                    <img src="{{ asset('storage/' . $photo) }}" alt="{{ $name }}, photo {{ $i + 1 }}" loading="lazy" width="200" height="150">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <ul class="pp-keyfacts">
                    @if ($property->bedrooms)<li><span>Bedrooms</span><strong>{{ $property->bedrooms }} BHK</strong></li>@endif
                    @if ($property->carpet)<li><span>Carpet area</span><strong>{{ \App\Support\Format::grouped($property->carpet) }} sq ft</strong></li>@endif
                    @if ($property->number_of_bathrooms)<li><span>Bathrooms</span><strong>{{ $property->number_of_bathrooms }}</strong></li>@endif
                    <li><span>Status</span><strong>{{ $property->under_construction ? 'Under construction' : 'Ready to move' }}</strong></li>
                </ul>

                @if ($property->description)
                    <section class="pp-panel" aria-labelledby="about-heading">
                        <h2 id="about-heading">About this property</h2>
                        <div class="property-description">{!! \App\Support\Html::clean($property->description) !!}</div>
                    </section>
                @endif

                <section class="pp-panel" aria-labelledby="details-heading">
                    <h2 id="details-heading">Details</h2>
                    <dl class="pp-specs">
                        @foreach ($specs as $label => $value)
                            <div><dt>{{ $label }}</dt><dd>{{ $value }}</dd></div>
                        @endforeach
                    </dl>
                </section>

                @foreach ($chipGroups as $heading => $items)
                    <section class="pp-panel" aria-label="{{ $heading }}">
                        <h2>{{ $heading }}</h2>
                        <ul class="pp-chips">
                            @foreach ($items as $item)
                                <li><i class="fa fa-check" aria-hidden="true"></i>{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    </section>
                @endforeach

                <section class="pp-panel" aria-labelledby="map-heading">
                    <h2 id="map-heading">Location</h2>
                    <p class="text-muted">{{ collect([optional($location)->street, optional($location)->locality, optional($location)->town, optional($location)->city, optional($location)->pincode])->filter()->implode(', ') }}</p>
                    @include('frontend.layouts._map', ['lat' => optional($location)->latitude, 'lng' => optional($location)->longitude, 'label' => $name])
                </section>
            </div>

            <aside class="col-lg-4" aria-label="Contact about this property">
                <div class="pp-panel pp-contact-card">
                    <p class="text-muted mb-1">{{ $property->isRent() ? 'Monthly rent' : 'Price' }}</p>
                    <p class="pp-contact-card__price">{{ $property->price_label }}</p>
                    <hr>
                    <p class="mb-3">Interested? Talk to the Perks advisor handling this listing.</p>
                    @if ($config->phone_href)
                        <a class="pp-btn pp-btn--navy pp-btn--block" href="tel:{{ $config->phone_href }}"><i class="fa fa-phone" aria-hidden="true"></i> Call {{ $config->phone_display }}</a>
                    @endif
                    @if ($config->whatsappUrl())
                        <a class="pp-btn pp-btn--whatsapp pp-btn--block" href="{{ $config->whatsappUrl($waText) }}" target="_blank" rel="noopener"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</a>
                    @endif
                    <button type="button" class="pp-btn pp-btn--primary pp-btn--block" data-toggle="modal" data-target="#enquiryModal"
                            data-enquire data-model="property" data-id="{{ $property->id }}" data-title="{{ $name }} ({{ $property->price_label }})">
                        Request a call back
                    </button>
                </div>
            </aside>
        </div>

        @if ($similar_properties->count())
            <section class="mt-8" aria-labelledby="similar-heading">
                <h2 class="pp-section__title mb-5" id="similar-heading">Similar properties</h2>
                <div class="pp-grid">
                    @foreach ($similar_properties as $similar)
                        @include('frontend.layouts.shared._property-card', ['property' => $similar])
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
@endsection

@section('cta-bar')
<div class="pp-cta-bar" role="region" aria-label="Contact about this property">
    @if ($config->phone_href)
        <a class="pp-btn pp-btn--navy" href="tel:{{ $config->phone_href }}"><i class="fa fa-phone" aria-hidden="true"></i> Call</a>
    @endif
    @if ($config->whatsappUrl())
        <a class="pp-btn pp-btn--whatsapp" href="{{ $config->whatsappUrl($waText) }}" target="_blank" rel="noopener"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</a>
    @endif
    <button type="button" class="pp-btn pp-btn--primary" data-toggle="modal" data-target="#enquiryModal"
            data-enquire data-model="property" data-id="{{ $property->id }}" data-title="{{ $name }} ({{ $property->price_label }})">Enquire</button>
</div>
@endsection
