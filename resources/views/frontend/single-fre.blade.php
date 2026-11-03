@extends('frontend.layouts.app')

@section('title'){{ "$fre->title | Perks Properties" }}@endsection
@section('seo-author', $config->default_seo_author)

@section('seo-description'){{ $fre->seo_description ?? $config->default_seo_description }}@endsection

@section('seo-keywords'){{ $config->default_seo_keywords . ($fre->seo_keywords ? ", $fre->seo_keywords" : '') }}@endsection

@section('seo-og-title'){{ $fre->seo_og_title ?? $config->default_seo_og_title }}@endsection

@section('seo-og-description'){{ $fre->seo_og_description ?? $config->default_seo_og_description }}@endsection


@section('main-content')
    @include('frontend.layouts.single-fre._bread-crumb')

    <div class="primary-content bg-gray-01 pt-7 pb-12">
        <div class="container">
            <div class="row">
                <article class="col-lg-8">

                    <!-- Gallery -->
                    @include('frontend.layouts.single-fre._gallery')
                    
                    <!-- Description -->
                    @include('frontend.layouts.single-fre._description')

                    <!-- Investion Information -->
                    @include('frontend.layouts.single-fre._investment-details')

                    <!-- Facts and Features -->
                    @include('frontend.layouts.single-fre._facts-and-features')

                    <!-- Additional Details -->
                    @include('frontend.layouts.single-fre._additiona-details')

                    <!-- Amenities-->
                    @if($fre->overviewKeypoints()->count() > 0)
                        @include('frontend.layouts.single-fre._amenities')
                    @endif

                    <!-- About The Developer -->
                    @include('frontend.layouts.single-fre._about-developer')

                    <!-- Tenant Overview -->
                    @include('frontend.layouts.single-fre._tenant-overview')

                    <!-- Location map-->
                    @include('frontend.layouts.single-fre._location')

                    <!-- Nearby places-->
                    @if($fre->surroundings()->count() > 0)
                        @include('frontend.layouts.single-fre._nearby-places')
                    @endif

                </article>

                <aside class="col-lg-4 pl-xl-4 primary-sidebar sidebar-sticky" id="sidebar">
                    <!-- sidebar-->
                    @include('frontend.layouts.single-fre._sidebar')
                </aside>
        	</div>
        </div>
    </div>
    
@endsection

@section('page-level-scripts')
    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key=AIzaSyCVXqFZF9JEMJdig_6ZFsBJjIFZ57DI2ac&sensor=false"></script>

    <script>
        initMapCoordinates("{{$fre->location->latitude}}", "{{$fre->location->longitude}}");
        initMarker("{{ 'fre-icon.png' }}");
    </script>

@endsection