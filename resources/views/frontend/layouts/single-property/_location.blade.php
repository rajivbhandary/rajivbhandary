<section class="mt-2 pb-6 px-6 pt-6 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-6">Location</h4>
    @include('frontend.layouts._map', ['lat' => optional($property->location)->latitude, 'lng' => optional($property->location)->longitude, 'label' => optional($property->location)->building_name])
</section>