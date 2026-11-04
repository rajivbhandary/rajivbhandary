<section class="mt-2 pb-6 px-6 pt-6 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-6">Location</h4>

    @include('frontend.layouts._map', ['lat' => optional($fre->location)->latitude, 'lng' => optional($fre->location)->longitude, 'label' => $fre->title])
</section>