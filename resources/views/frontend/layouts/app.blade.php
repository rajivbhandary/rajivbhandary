<!DOCTYPE html>
<html lang="en-IN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        // Section content arrives HTML-escaped; decode once so it is escaped exactly once below.
        $section = function ($name) use ($__env) {
            return trim(html_entity_decode($__env->yieldContent($name), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        };
        $pageTitle = $section('title') ?: 'Perks Properties';
        $pageDescription = $section('seo-description') ?: ($config->default_seo_description ?? '');
        $ogTitle = $section('seo-og-title') ?: $pageTitle;
        $ogDescription = $section('seo-og-description') ?: $pageDescription;
        $ogImage = $section('og-image') ?: asset('assets/frontend/img/brand/og-image.jpg');
        $canonical = $section('canonical') ?: url()->current();
    @endphp
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit($pageDescription, 160, '') }}">
    <link rel="canonical" href="{{ $canonical }}">
    @hasSection('robots')<meta name="robots" content="@yield('robots')">@endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0E213C">

    <meta property="og:type" content="@yield('og-type', 'website')">
    <meta property="og:site_name" content="Perks Properties">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit($ogDescription, 200, '') }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" href="{{ asset('assets/admin/media/logos/favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Poppins:wght@400;500;600;700&display=swap">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/perks.css') }}?v=20261104b">
    @yield('page-level-styles')

    <script type="application/ld+json">
    {!! json_encode(array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'RealEstateAgent',
        'name' => 'Perks Properties',
        'url' => url('/'),
        'logo' => asset('assets/frontend/img/brand/perks-logo.png'),
        'image' => asset('assets/frontend/img/brand/og-image.jpg'),
        'telephone' => $config->phone_href ?? null,
        'email' => $config->contact_email ?? null,
        'foundingDate' => '1999',
        'areaServed' => ['Mumbai', 'Thane'],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Office No. 32, Maker Arcade, Cuffe Parade',
            'addressLocality' => 'Mumbai',
            'addressRegion' => 'Maharashtra',
            'postalCode' => '400005',
            'addressCountry' => 'IN',
        ],
    ]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}
    </script>
    @yield('structured-data')

    @if (config('services.google_analytics.id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', @json(config('services.google_analytics.id')));
        </script>
    @endif
</head>
<body class="@yield('body-class')">
    <a class="pp-skip" href="#main">Skip to content</a>

    @include('frontend.layouts._header')

    <main id="main" tabindex="-1">
        @yield('main-content')
    </main>

    @include('frontend.layouts._footer')

    @include('frontend.layouts.shared._enquiry-modal')

    @yield('cta-bar')

    <script src="{{ asset('assets/frontend/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/perks.js') }}?v=20261104b"></script>
    @yield('page-level-scripts')
</body>
</html>
