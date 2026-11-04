<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Page;
use App\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    private const PER_PAGE = 10;

    public function index(Request $request)
    {
        return $this->listing($request, []);
    }

    /**
     * Search results. GET, so results can be refreshed, bookmarked and shared.
     */
    public function advanceSearch(Request $request)
    {
        return $this->listing($request, $this->searchFilters($request));
    }

    public function show(Property $property)
    {
        $property->load(['location', 'image.image', 'rentDetail', 'residential']);

        $similar_properties = Property::withoutTrashed()
            ->with(['location', 'rentDetail', 'residential'])
            ->where('id', '!=', $property->id)
            ->where('type', $property->type)
            ->where('status', $property->status)
            ->latest()
            ->limit(3)
            ->get();

        return view('frontend.single-property', compact('similar_properties', 'property'));
    }

    private function listing(Request $request, array $filters)
    {
        $query = Property::withoutTrashed()
            ->with(['location', 'rentDetail', 'residential'])
            ->withCount('image');
        if ($filters) {
            $query->advanceSearch($filters);
        }

        $sort = $request->query('sort');
        if ($sort === 'price-low' || $sort === 'price-high') {
            $query->orderByRaw('COALESCE(properties.price, (SELECT amount FROM rent_details WHERE rent_details.id = properties.rent_detail_id)) ' . ($sort === 'price-low' ? 'ASC' : 'DESC'));
        } else {
            $query->latest('properties.created_at');
        }

        $properties = $query->paginate(self::PER_PAGE)->withQueryString();
        $property_count = $properties->total();
        $page_seo = Page::where('route_name', 'frontend.properties')->first();

        return view('frontend.property-list', compact('properties', 'property_count', 'page_seo', 'filters'));
    }

    /**
     * Normalise the search form into a filters array. Accepts both the
     * current field names and the old slider text ("₹0 to ₹2,00,000").
     */
    private function searchFilters(Request $request)
    {
        [$minPrice, $maxPrice] = $this->range($request, 'min_price', 'max_price', 'price', 200000000);
        [$minArea, $maxArea] = $this->range($request, 'min_area', 'max_area', 'sqrt', 4000);

        $type = $request->query('type');
        $legacyType = $request->query('property-type');
        if (!$type && $legacyType) {
            $type = $legacyType === '1' ? 'residential' : ($legacyType === '2' ? 'commercial' : null);
        }
        $subtype = $request->query('subtype');
        $legacySubtype = $request->query('property-subtype');
        if (!$subtype && $legacySubtype) {
            $subtype = ['1' => 'offices', '2' => 'shops', '3' => 'others', '4' => 'land'][$legacySubtype] ?? null;
        }

        return array_filter([
            'status' => in_array($request->query('status'), ['for-buy', 'for-rent'], true) ? $request->query('status') : null,
            'search' => trim((string) $request->query('search')) ?: null,
            'town' => trim((string) $request->query('town', $request->query('location-town'))) ?: null,
            'type' => in_array($type, ['residential', 'commercial'], true) ? $type : null,
            'subtype' => in_array($subtype, ['offices', 'shops', 'others', 'land'], true) ? $subtype : null,
            'bedrooms' => $this->positiveInt($request->query('bedrooms', $request->query('property-bedrooms'))),
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'min_area' => $minArea,
            'max_area' => $maxArea,
        ], function ($value) {
            return $value !== null;
        });
    }

    private function range(Request $request, $minKey, $maxKey, $legacyKey, $openEndedMax)
    {
        $min = $this->positiveInt($request->query($minKey));
        $max = $this->positiveInt($request->query($maxKey));

        $legacy = (string) $request->query($legacyKey);
        if ($min === null && $max === null && strpos($legacy, 'to') !== false) {
            [$from, $to] = array_map(function ($part) {
                return preg_replace('/\D+/', '', $part);
            }, explode('to', $legacy, 2));
            $min = $from !== '' ? (int) $from : null;
            $max = $to !== '' ? (int) $to : null;
        }

        // The sliders' top value means "and above"; 0 means "no minimum".
        if ($max !== null && $max >= $openEndedMax) {
            $max = null;
        }
        if ($min === 0) {
            $min = null;
        }

        return [$min, $max];
    }

    private function positiveInt($value)
    {
        return is_numeric($value) && (int) $value >= 0 ? (int) $value : null;
    }
}
