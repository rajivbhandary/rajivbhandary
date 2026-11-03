<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- begin::Head -->
<head>
    <base href="../../">
    <meta charset="utf-8"/>
    <title>@yield('title', 'Perks Properties')</title>
    <meta name="description" content="Page with empty content">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
@yield("meta")

<!--begin::Fonts -->
{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700"> --}}

<!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>

    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <!--end::Global Theme Styles -->

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!--begin::Layout Skins(used by all pages) -->

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/favicon.ico') }}"/>

    <style>
        .kt-header__brand {
            background-color: #FFF !important;
        }
    </style>

    @yield('styles')

</head>

<!-- end::Head -->

<!-- begin::Body -->
<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
@include('admin.layouts.partials._header-mobile')
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper pl-0" id="kt_wrapper">
            <!-- begin:: Header -->
        @include('admin.layouts.partials._header')
        <!-- end:: Header -->

        @yield('content')


        <!-- begin:: Footer -->
        @include('admin.layouts.partials._footer')

        <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#22b9ff",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/scripts.bundle.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"
        type="text/javascript"></script>
<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="{{ asset('assets/admin/plugins/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>

<!--end::Page Vendors -->


@yield('scripts')
<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
