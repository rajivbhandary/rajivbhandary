<section class="pp-section" aria-labelledby="blog-title">
    <div class="container">
        <div class="pp-section__head">
            <div>
                <span class="pp-eyebrow">From the blog</span>
                <h2 class="pp-section__title" id="blog-title">Advice for buyers, sellers and tenants</h2>
            </div>
            <a href="{{ route('frontend.blogs') }}" class="pp-btn pp-btn--outline">All articles</a>
        </div>
        <div class="pp-cols-3">
            @foreach ($blogs->take(3) as $blog)
                @include('frontend.layouts.shared._blog-card', ['blog' => $blog])
            @endforeach
        </div>
    </div>
</section>
