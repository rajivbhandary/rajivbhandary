@php
    $url = route('frontend.single-fre', $fre->slug);
    $place = collect([optional($fre->location)->locality, optional($fre->location)->town])->filter()->unique()->implode(', ');
    $minInvestment = is_numeric(preg_replace('/[^\d.]/', '', (string) $fre->minimum_investment))
        ? \App\Support\Format::inr(preg_replace('/[^\d.]/', '', (string) $fre->minimum_investment))
        : $fre->minimum_investment;
@endphp
<article class="pp-card">
    <a href="{{ $url }}" class="pp-card__media" tabindex="-1" aria-hidden="true">
        <img src="{{ asset('storage/' . $fre->feature_image_path) }}" alt="" loading="lazy" width="600" height="400">
        <span class="pp-card__badges"><span class="pp-badge pp-badge--rent">Fractional</span></span>
    </a>
    <div class="pp-card__body">
        <p class="pp-card__price">From {{ $minInvestment }}</p>
        <h3 class="pp-card__title"><a href="{{ $url }}">{{ $fre->title }}</a></h3>
        <p class="pp-card__place"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $place ?: optional($fre->location)->city }}</p>
        <ul class="pp-card__facts">
            @if ($fre->rental_yield !== null && $fre->rental_yield !== '')<li>Rental yield <strong>{{ $fre->rental_yield }}%</strong></li>@endif
            @if ($fre->gross_yield !== null && $fre->gross_yield !== '')<li>Gross yield <strong>{{ $fre->gross_yield }}%</strong></li>@endif
            @if ($fre->built_up_area)<li><strong>{{ \App\Support\Format::grouped($fre->built_up_area) }}</strong> sq ft</li>@endif
        </ul>
    </div>
</article>
