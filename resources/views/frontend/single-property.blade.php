@extends('frontend.layouts.app')

@php($location = $property->location)
@section('title'){{ "$location->building_name | Perks Properties" }}@endsection
@section('seo-author', $config->default_seo_author)

@section('seo-description'){{ $property->seo_description ?? $config->default_seo_description }}@endsection

@section('seo-keywords'){{ $config->default_seo_keywords . ($property->seo_keywords ? ", $property->seo_keywords" : '') }}@endsection

@section('seo-og-title'){{ $property->seo_og_title ?? $config->default_seo_og_title }}@endsection

@section('seo-og-description'){{ $property->seo_og_description ?? $config->default_seo_og_description }}@endsection



@section('main-content')
    @include('frontend.layouts.single-property._bread-crumb')

    <div class="primary-content bg-gray-01 pt-7 pb-12">
        <div class="container">
            <div class="row">
                <article class="col-lg-8">

                    <!-- Gallery -->
                    @include('frontend.layouts.single-property._gallery')
                    
                    <!-- Description -->
                    @include('frontend.layouts.single-property._description')

                    <!-- Facts and Features -->
                    @include('frontend.layouts.single-property._facts-and-features')

                    <!-- Additional Details -->
                    @include('frontend.layouts.single-property._additional-details')

                    <!-- Amenities-->
                    @include('frontend.layouts.single-property._amenities')

                    <!-- Location map-->
                    @include('frontend.layouts.single-property._location')

                    <!-- Nearby places-->
                    @include('frontend.layouts.single-property._nearby-places')
                </article>

                <aside class="col-lg-4 pl-xl-4 primary-sidebar sidebar-sticky" id="sidebar">
                    <!-- sidebar-->
                    @include('frontend.layouts.single-property._sidebar')
                </aside>
        	</div>
        </div>
    </div>
    
@endsection

@section('page-level-scripts')

@endsection