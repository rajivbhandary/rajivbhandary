{{--
    Page title band with breadcrumbs.
    Expects: $title; optional $crumbs = [['label' => .., 'url' => ..], ...]
--}}
<section class="page-hero">
    <div class="container">
        <nav aria-label="Breadcrumb">
            <ol class="page-hero__crumbs">
                <li><a href="{{ route('frontend.index') }}">Home</a></li>
                @foreach (($crumbs ?? []) as $crumb)
                    <li><a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a></li>
                @endforeach
                <li aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
        <h1 class="page-hero__title">{{ $title }}</h1>
        @isset($subtitle)
            <p class="page-hero__subtitle">{{ $subtitle }}</p>
        @endisset
    </div>
</section>
