<section class="pp-section" aria-labelledby="latest-title">
    <div class="container">
        <div class="pp-section__head">
            <div>
                <span class="pp-eyebrow">Latest listings</span>
                <h2 class="pp-section__title" id="latest-title">New on Perks Properties</h2>
            </div>
            <a href="{{ route('frontend.properties') }}" class="pp-btn pp-btn--outline">
                View all {{ $properties->count() + $property_count }} properties <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
        <div class="pp-grid">
            @foreach ($properties as $property)
                @include('frontend.layouts.shared._property-card', ['property' => $property])
            @endforeach
        </div>
    </div>
</section>
