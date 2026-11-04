@extends('frontend.layouts.app')

@php
    $published = $blog->published_at ? \Carbon\Carbon::parse($blog->published_at) : null;
    $summary = \App\Support\Html::text($blog->excerpt ?: $blog->body);
@endphp

@section('title'){{ $blog->title }} | Perks Properties Blog
@endsection
@section('seo-description'){{ $blog->seo_description ?: \Illuminate\Support\Str::limit($summary, 155) }}
@endsection
@section('seo-og-title'){{ $blog->seo_og_title ?: $blog->title }}
@endsection
@section('seo-og-description'){{ $blog->seo_og_description ?: \Illuminate\Support\Str::limit($summary, 190) }}
@endsection
@section('og-image'){{ asset('storage/' . $blog->image) }}
@endsection
@section('og-type', 'article')

@section('structured-data')
<script type="application/ld+json">
{!! json_encode(array_filter([
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $blog->title,
    'image' => asset('storage/' . $blog->image),
    'datePublished' => optional($published)->toAtomString(),
    'dateModified' => optional($blog->updated_at)->toAtomString(),
    'author' => ['@type' => 'Person', 'name' => optional($blog->author)->name],
    'publisher' => ['@type' => 'Organization', 'name' => 'Perks Properties', 'logo' => ['@type' => 'ImageObject', 'url' => asset('assets/frontend/img/brand/perks-logo.png')]],
    'mainEntityOfPage' => url()->current(),
]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}
</script>
@endsection

@section('main-content')
    @include('frontend.layouts.shared._page-hero', [
        'title' => $blog->title,
        'crumbs' => [['label' => 'Blog', 'url' => route('frontend.blogs')]],
    ])

    <section class="pp-section pt-6">
        <div class="container">
            <div class="row">
                <article class="col-lg-8">
                    <p class="pp-post__meta mb-3">
                        By {{ optional($blog->author)->name }}
                        @if ($published) &middot; <time datetime="{{ $published->toDateString() }}">{{ $published->format('j F Y') }}</time>@endif
                    </p>
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="" class="rounded-lg mb-5 w-100" width="1200" height="700">
                    <div class="pp-prose">{!! \App\Support\Html::clean($blog->body) !!}</div>
                    @if ($blog->tags->count())
                        <ul class="pp-chips mt-6" aria-label="Topics">
                            @foreach ($blog->tags as $t)
                                <li><a href="{{ route('frontend.blogs.tag', $t->slug) }}">{{ $t->name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </article>
                <aside class="col-lg-4 mt-8 mt-lg-0" aria-label="More articles">
                    <div class="pp-panel">
                        <h2>Looking for a property?</h2>
                        <p>Tell us what you need and an advisor will call you back.</p>
                        <button type="button" class="pp-btn pp-btn--primary pp-btn--block" data-toggle="modal" data-target="#enquiryModal" data-enquire>Request a call back</button>
                    </div>
                    @if ($latest_blogs->count())
                        <div class="pp-panel">
                            <h2>Recent articles</h2>
                            <ul class="list-unstyled mb-0">
                                @foreach ($latest_blogs as $related)
                                    <li class="mb-3"><a href="{{ route('frontend.single-blog', $related->slug) }}" class="font-weight-500">{{ $related->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($tags->count())
                        <div class="pp-panel">
                            <h2>Topics</h2>
                            <ul class="pp-chips">
                                @foreach ($tags as $t)
                                    <li><a href="{{ route('frontend.blogs.tag', $t->slug) }}">{{ $t->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>
@endsection
