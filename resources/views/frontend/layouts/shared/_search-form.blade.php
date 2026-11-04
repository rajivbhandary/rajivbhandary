{{--
    Property search used on the homepage and the listings page.
    Optional: $filters (current search), $id (unique prefix for field ids).
--}}
@php
    $f = $filters ?? [];
    $id = $id ?? 'search';
    $status = $f['status'] ?? 'for-buy';
    $budgets = [
        10000 => '₹10,000', 25000 => '₹25,000', 50000 => '₹50,000', 100000 => '₹1 L',
        500000 => '₹5 L', 2500000 => '₹25 L', 5000000 => '₹50 L', 10000000 => '₹1 Cr',
        20000000 => '₹2 Cr', 50000000 => '₹5 Cr',
    ];
    $hasMore = !empty($f['town']) || !empty($f['bedrooms']) || !empty($f['min_price']) || !empty($f['max_price'])
        || !empty($f['min_area']) || !empty($f['max_area']);
@endphp
<form class="pp-search" action="{{ route('frontend.advance-search') }}" method="GET" role="search" aria-label="Search properties">
    <fieldset class="pp-search__tabs">
        <legend class="sr-only">I want to</legend>
        <input type="radio" id="{{ $id }}-buy" name="status" value="for-buy" @if($status === 'for-buy') checked @endif>
        <label for="{{ $id }}-buy">Buy</label>
        <input type="radio" id="{{ $id }}-rent" name="status" value="for-rent" @if($status === 'for-rent') checked @endif>
        <label for="{{ $id }}-rent">Rent</label>
    </fieldset>

    <div class="pp-search__row">
        <div class="pp-field pp-field--grow">
            <label for="{{ $id }}-q">Location, building or pincode</label>
            <input type="search" id="{{ $id }}-q" name="search" value="{{ $f['search'] ?? '' }}" placeholder="e.g. Mulund, Bhakti Marg, 400080" autocomplete="off">
        </div>
        <div class="pp-field">
            <label for="{{ $id }}-type">Property type</label>
            <select id="{{ $id }}-type" name="type" data-subtype-target="#{{ $id }}-subtype-wrap">
                <option value="">Any</option>
                <option value="residential" @if(($f['type'] ?? '') === 'residential') selected @endif>Residential</option>
                <option value="commercial" @if(($f['type'] ?? '') === 'commercial') selected @endif>Commercial</option>
            </select>
        </div>
        <div class="pp-field" id="{{ $id }}-subtype-wrap">
            <label for="{{ $id }}-subtype">Commercial type</label>
            <select id="{{ $id }}-subtype" name="subtype">
                <option value="">Any</option>
                @foreach (['offices' => 'Office', 'shops' => 'Shop', 'land' => 'Land', 'others' => 'Other'] as $value => $label)
                    <option value="{{ $value }}" @if(($f['subtype'] ?? '') === $value) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="pp-btn pp-btn--primary pp-search__submit">
            <i class="fa fa-search" aria-hidden="true"></i> Search
        </button>
    </div>

    <details class="pp-search__more" @if($hasMore) open @endif>
        <summary>More filters</summary>
        <div class="pp-search__grid">
            <div class="pp-field">
                <label for="{{ $id }}-town">Area / town</label>
                <input type="text" id="{{ $id }}-town" name="town" value="{{ $f['town'] ?? '' }}" placeholder="e.g. Thane">
            </div>
            <div class="pp-field">
                <label for="{{ $id }}-bhk">Bedrooms</label>
                <select id="{{ $id }}-bhk" name="bedrooms">
                    <option value="">Any</option>
                    @foreach ([1, 2, 3, 4, 5] as $n)
                        <option value="{{ $n }}" @if(($f['bedrooms'] ?? null) == $n) selected @endif>{{ $n }} BHK</option>
                    @endforeach
                </select>
            </div>
            <div class="pp-field">
                <label for="{{ $id }}-min-price">Min budget</label>
                <select id="{{ $id }}-min-price" name="min_price">
                    <option value="">No min</option>
                    @foreach ($budgets as $value => $label)
                        <option value="{{ $value }}" @if(($f['min_price'] ?? null) == $value) selected @endif>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="pp-field">
                <label for="{{ $id }}-max-price">Max budget</label>
                <select id="{{ $id }}-max-price" name="max_price">
                    <option value="">No max</option>
                    @foreach ($budgets as $value => $label)
                        <option value="{{ $value }}" @if(($f['max_price'] ?? null) == $value) selected @endif>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="pp-field">
                <label for="{{ $id }}-min-area">Min carpet area (sq ft)</label>
                <input type="number" inputmode="numeric" min="0" step="50" id="{{ $id }}-min-area" name="min_area" value="{{ $f['min_area'] ?? '' }}">
            </div>
            <div class="pp-field">
                <label for="{{ $id }}-max-area">Max carpet area (sq ft)</label>
                <input type="number" inputmode="numeric" min="0" step="50" id="{{ $id }}-max-area" name="max_area" value="{{ $f['max_area'] ?? '' }}">
            </div>
        </div>
    </details>
</form>
