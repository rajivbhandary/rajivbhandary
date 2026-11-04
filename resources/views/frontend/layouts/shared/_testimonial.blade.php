<figure class="pp-quote">
    <blockquote class="pp-quote__text mb-0">{!! \App\Support\Html::clean($testimonial->testimonial) !!}</blockquote>
    <figcaption class="pp-quote__who">
        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="" loading="lazy" width="48" height="48">
        <span><strong>{{ $testimonial->name }}</strong>@if($testimonial->city)<span>{{ $testimonial->city }}</span>@endif</span>
    </figcaption>
</figure>
