{{--
    Keyless Google Maps embed, loaded only when scrolled into view.
    Expects: $lat, $lng, $label
--}}
@php
    $hasCoords = is_numeric($lat ?? null) && is_numeric($lng ?? null);
    $query = $hasCoords ? $lat . ',' . $lng : ($label ?? 'Mumbai');
@endphp
<div class="map-embed rounded-lg overflow-hidden">
    <iframe
        title="Map showing {{ $label ?? 'the location' }}"
        src="https://www.google.com/maps?q={{ urlencode($query) }}&z=16&output=embed"
        width="100%" height="360" style="border:0" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
</div>
<a class="d-inline-block mt-3 font-weight-500" target="_blank" rel="noopener"
   href="https://www.google.com/maps/search/?api=1&query={{ urlencode($query) }}">
    <i class="fa fa-map-marker mr-1" aria-hidden="true"></i> Get directions
</a>
