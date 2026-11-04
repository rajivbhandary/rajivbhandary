<article class="pp-post">
    <img src="{{ asset('storage/' . $blog->image) }}" alt="" loading="lazy" width="600" height="375">
    <div class="pp-post__body">
        <p class="pp-post__meta">
            {{ optional($blog->author)->name }}
            @if ($blog->published_at)
                &middot; <time datetime="{{ \Carbon\Carbon::parse($blog->published_at)->toDateString() }}">{{ \Carbon\Carbon::parse($blog->published_at)->format('j M Y') }}</time>
            @endif
        </p>
        <h3><a href="{{ route('frontend.single-blog', $blog->slug) }}">{{ $blog->title }}</a></h3>
        <p>{{ \Illuminate\Support\Str::limit(\App\Support\Html::text($blog->excerpt), 130) }}</p>
    </div>
</article>
