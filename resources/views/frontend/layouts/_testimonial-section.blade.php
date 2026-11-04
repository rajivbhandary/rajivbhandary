<section class="pp-section pp-section--tint" aria-labelledby="stories-title">
    <div class="container">
        <div class="pp-section__head">
            <div>
                <span class="pp-eyebrow">Client stories</span>
                <h2 class="pp-section__title" id="stories-title">What our clients say</h2>
            </div>
            <a href="{{ route('frontend.testimonials') }}" class="pp-btn pp-btn--outline">Read more stories</a>
        </div>
        <div class="pp-cols-3">
            @foreach ($testimonials->take(3) as $testimonial)
                @include('frontend.layouts.shared._testimonial', ['testimonial' => $testimonial])
            @endforeach
        </div>
    </div>
</section>
