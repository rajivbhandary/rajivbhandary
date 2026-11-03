@extends('admin.layouts.template')

@section('title', 'Pages | Perks Properties')

@section('content')
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">

        @include('admin.layouts.partials._message')

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Manage Pages
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-hover table-checkable" id="pages_datatable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>URL</th>
                        <th>SEO Description</th>
                        <th>SEO Keywords</th>
                        <th>SEO OG Title</th>
                        <th>SEO OG Description</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('styles')
    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ asset("assets/admin/plugins/custom/datatables/datatables.bundle.css") }}" rel="stylesheet"
          type="text/css"/>

    <!--end::Page Vendors Styles -->
@endsection

@section('scripts')
    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ asset("assets/admin/plugins/custom/datatables/datatables.bundle.js") }}" type="text/javascript"></script>

    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset("assets/admin/js/page-level/pages/manage-pages.js") }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endsection
