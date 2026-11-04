{{--
    Listing card used on the homepage, search results and "similar" lists.
    Expects: $property (with location, rentDetail, residential loaded).
--}}
@php
    $location = $property->location;
    $url = route('frontend.single-property', $property->slug);
    $place = collect([optional($location)->locality, optional($location)->town])->filter()->unique()->implode(', ');
@endphp
<article class="pp-card">
    <a href="{{ $url }}" class="pp-card__media" tabindex="-1" aria-hidden="true">
        <img src="{{ asset('storage/' . $property->feature_image_path) }}"
             alt="" loading="lazy" decoding="async" width="600" height="400">
        <span class="pp-card__badges">
            <span class="pp-badge pp-badge--{{ $property->isRent() ? 'rent' : 'sale' }}">{{ $property->isRent() ? 'For rent' : 'For sale' }}</span>
            <span class="pp-badge pp-badge--muted">{{ $property->type }}</span>
        </span>
        @if ($property->photo_count)
            <span class="pp-card__photos"><i class="fa fa-camera" aria-hidden="true"></i> {{ $property->photo_count }}</span>
        @endif
    </a>
    <div class="pp-card__body">
        <p class="pp-card__price">{{ $property->price_label }}</p>
        <h3 class="pp-card__title"><a href="{{ $url }}">{{ optional($location)->building_name ?: $property->headline }}</a></h3>
        <p class="pp-card__place"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $place ?: optional($location)->city }}</p>
        <ul class="pp-card__facts">
            @if ($property->bedrooms)
                <li><strong>{{ $property->bedrooms }}</strong> BHK</li>
            @endif
            @if ($property->number_of_bathrooms)
                <li><strong>{{ $property->number_of_bathrooms }}</strong> {{ \Illuminate\Support\Str::plural('bath', $property->number_of_bathrooms) }}</li>
            @endif
            @if ($property->carpet)
                <li><strong>{{ \App\Support\Format::grouped($property->carpet) }}</strong> sq ft</li>
            @endif
        </ul>
    </div>
</article>
