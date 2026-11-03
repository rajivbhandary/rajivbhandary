<?php

namespace App\Http\Controllers\frontend;

use App\Config;
use App\Http\Controllers\Controller;
use App\ImageProperty;
use App\Page;
use App\Property;
use Carbon\Carbon;
use Hamcrest\Core\IsTypeOf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PropertiesController extends Controller
{
    public function index()
    {
        $properties = Property::withoutTrashed()->latest()->paginate(10);
        $property_count = Property::count();
        $config = Config::first();
        $property_types = [["id" => 1, "value" =>'Residential'],["id" => 2, "value" =>'Commercial']];
        $page_seo = Page::where('route_name', \Illuminate\Support\Facades\Request::route()->getName())->first();
        return view('frontend.property-list', compact([
            'config',
            'page_seo',
            'properties',
            'property_count',
            'property_types',
        ]));
    }

    public function show(Property $property)
    {
        if(Property::findOrFail($property->id)){
            $similar_properties = Property::withoutTrashed()->latest()->where('id', '!=', $property->id)->where('type', '=', $property->type)->where('status', '=', $property->status)->limit(2)->get();

            $config = Config::first();

            return view('frontend.single-property', compact([
                'similar_properties',
                'property',
                'config'
            ]));
        }else{
            abort(404);
        }
    }

    public function advanceSearch(Request $request){
        // dd($request);
        $request->price = str_replace(',', '', $request->price);
        $request->price = str_replace('₹', '', $request->price);
        $request->min_price = (int)Str::before($request->price, ' to');
        $request->max_price = (int)Str::after($request->price, 'to ');

        $request->sqrt = str_replace(' sqft', '', $request->sqrt);

        $request->min_sqrt = (int)Str::before($request->sqrt, ' to');
        $request->max_sqrt = (int)Str::after($request->sqrt, 'to ');

        // dd(gettype($request->min_price));
        
        
        $properties = Property::withoutTrashed()->advanceSearch($request)->paginate(10);
        // $properties = Property::withoutTrashed()->advanceSearch($request)->toSql();
        // dd($properties);
        $property_count = Property::withoutTrashed()->advanceSearch($request)->count();
        $config = Config::first();
        $property_types = [["id" => 1, "value" =>'Residential'],["id" => 2, "value" =>'Commercial']];
        $page_seo = Page::where('route_name', \Illuminate\Support\Facades\Request::route()->getName())->first();

        return view('frontend.property-list', compact([
            'config',
            'page_seo',
            'properties',
            'property_count',
            'property_types',
            'request',
        ]));
    }
}
