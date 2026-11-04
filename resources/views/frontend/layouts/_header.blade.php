@php
    $route = optional(request()->route())->getName();
    $links = [
        ['Properties', 'frontend.properties', ['frontend.properties', 'frontend.single-property', 'frontend.advance-search']],
        ['Fractional ownership', 'frontend.fre', ['frontend.fre', 'frontend.single-fre']],
        ['About', 'frontend.about-us', ['frontend.about-us', 'frontend.testimonials']],
        ['Blog', 'frontend.blogs', ['frontend.blogs', 'frontend.single-blog', 'frontend.blogs.tag']],
        ['Contact', 'frontend.contact-us', ['frontend.contact-us']],
    ];
@endphp
<header class="pp-header">
    <div class="container pp-header__inner">
        <a class="pp-header__logo" href="{{ route('frontend.index') }}" aria-label="Perks Properties home">
            <img src="{{ asset('assets/frontend/img/brand/perks-logo.png') }}" alt="Perks Properties" width="145" height="44">
        </a>

        <button class="pp-menu-toggle" type="button" aria-controls="pp-nav" aria-expanded="false" aria-label="Menu">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>

        <nav class="pp-nav" id="pp-nav" aria-label="Main">
            <ul>
                @foreach ($links as [$label, $name, $active])
                    <li>
                        <a href="{{ route($name) }}" @if(in_array($route, $active, true)) aria-current="page" @endif>{{ $label }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

        @if ($config->phone_href)
            <a class="pp-btn pp-btn--primary pp-btn--sm pp-header__call" href="tel:{{ $config->phone_href }}">
                <i class="fa fa-phone" aria-hidden="true"></i> {{ $config->phone_display }}
            </a>
        @else
            <button type="button" class="pp-btn pp-btn--primary pp-btn--sm pp-header__call" data-toggle="modal" data-target="#enquiryModal" data-enquire>
                Enquire
            </button>
        @endif
    </div>
</header>
