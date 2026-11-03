@extends('admin.layouts.template')

@section('title', 'Dashboard | Perks Properties')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
        @include('admin.layouts.partials._message')
        <!-- Cards -->
        <div class="kt-portlet">
            <div class="kt-portlet__body  kt-portlet__body--fit">
                <div class="row row-no-padding row-col-separator-lg">
                    <div class="col-md-6 col-lg-4 col-xl-2">

                        <!--begin:: Properties-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details justify-content-center">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">Properties</h4>
                                    <span class="kt-widget24__stats kt-font-brand p-0 d-block w-100 text-center">{{$property_count}}</span>
                                </div>
                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-2">

                        <!--begin::New Feedbacks-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details justify-content-center">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                       FREs
                                    </h4>
                                    <span class="kt-widget24__stats kt-font-warning p-0 d-block w-100 text-center">{{$fre_count}}</span>
                                </div>
                            </div>
                        </div>

                        <!--end::New Feedbacks-->
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-2">

                        <!--begin::New Orders-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details justify-content-center">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                       Blogs
                                    </h4>
                                    <span class="kt-widget24__stats kt-font-danger p-0 d-block w-100 text-center">{{$blog_count}}</span>
                                </div>  
                            </div>
                        </div>

                        <!--end::New Orders-->
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-2">

                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details justify-content-center">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Testimonials
                                    </h4>
                                    <span class="kt-widget24__stats kt-font-success p-0 d-block w-100 text-center">{{$testimonial_count}}</span>
                                </div>
                            </div>
                        </div>

                        <!--end::New Users-->
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-2">

                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details justify-content-center">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                       Enquiries
                                    </h4>
                                    <span class="kt-widget24__stats kt-font-success p-0 d-block w-100 text-center">{{$enquiry_count}}</span>
                                </div>
                            </div>
                        </div>

                        <!--end::New Users-->
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-2">

                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details justify-content-center">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Visits
                                    </h4>
                                    <span class="kt-widget24__stats kt-font-success p-0 d-block w-100 text-center">{{$visit_count}}</span>
                                </div>
                            </div>
                        </div>

                        <!--end::New Users-->
                    </div>
                </div>
            </div>
        </div>
        <!-- /Cards -->

        @if($property_count > 0)
            <div class="row">
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon kt-hidden">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Property Status Statistics
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="rent_sell_chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon kt-hidden">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Property Type Statistics
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="residential_commercial_chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon kt-hidden">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Monthwise Property Distribution
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="current_year_property_chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($fre_count > 0)
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon kt-hidden">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Monthwise FRE Distribution
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="current_year_fre_chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enquiries Datatable -->
        @if($enquiries->count() > 0)
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Enquiries
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a href="{{ route('enquiries.index')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-eye"></i>
                                    View Enquiries
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="enquiries_datatable">
                        <thead>
                        <tr>
                        <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Message</th>
                            <th>Source</th>
                            <th>City</th>
                            <th>State</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($enquiries as $enquiry)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$enquiry->name}}</td>
                                    <td>{{$enquiry->email}}</td>
                                    <td>{{$enquiry->phone_number}}</td>
                                    <td>{{$enquiry->message}}</td>
                                    <td>{{$enquiry->source}}</td>
                                    <td>{{$enquiry->city}}</td>
                                    <td>{{$enquiry->state}}</td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        @endif
        <!-- /Enquiries Datatable -->

        <!-- Visits Datatable -->
        @if($visits->count() > 0)
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Visits
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a href="{{ route('visits.index')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-eye"></i>
                                    View Visits
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="visits_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Visited At</th>
                            <th>Method</th>
                            <th>URL</th>
                            <th>IP</th>
                            <th>Platform</th>
                            <th>Browser</th>
                            <th>Device</th>
                            <th>Languages</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($visits as $visit)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$visit->created_at->diffForHumans()}}</td>
                                    <td>{{$visit->method}}</td>
                                    <td>{{$visit->url}}</td>
                                    <td>{{$visit->ip}}</td>
                                    <td>{{$visit->platform}}</td>
                                    <td>{{$visit->browser}}</td>
                                    <td>{{$visit->device}}</td>
                                    <td>{{$visit->languages}}</td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        @endif
        <!-- /Visits Datatable -->
    </div>

@endsection

@section('scripts')
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/admin/js/pages/dashboard.js') }}" type="text/javascript"></script>
    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ asset('assets/admin/plugins/custom/flot/flot.bundle.js')}}" type="text/javascript"></script>

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

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/admin/js/page-level/dashboard/manage-dashboard.js') }}" type="text/javascript"></script>
    <!--end::Page Scripts -->
@endsection
