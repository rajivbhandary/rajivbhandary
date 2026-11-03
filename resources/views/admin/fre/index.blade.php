@extends('admin.layouts.template')

@section('title', 'FREs | Perks Properties')

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
                        Manage FREs
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{ route('frontend.fre')}}" class="btn btn-default mr-1">
                                <i class="la la-eye"></i>
                                View All
                            </a>

                            <a href="{{ route('fre.trashed')}}" class="btn btn-default mr-1">
                                <i class="la la-exclamation-triangle"></i>
                                Trashed
                            </a>

                            <a href="{{ route('fre.create') }}" class="btn btn-brand btn-elevate">
                                <i class="la la-plus"></i>
                                Create FRE
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-hover table-checkable" id="fre_datatable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <!-- <th>Image</th> -->
                        <th>Feature Image</th>
                        <th>Title</th>
                        <th>Address</th>
                        <th>Developer Name</th>
                        <th>Total Price</th>
                        <th>Possesion Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->

    <!--DELETE MODAL-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Trash FRE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Are you sure want to trash the FRE ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label btn-label-dark btn-bold btn-sm m-1" data-dismiss="modal"><i class='kt-menu__link-icon flaticon2-cancel-music'></i>Close</button>
                        <button type="submit" class="btn btn-label btn-label-danger btn-bold btn-sm m-1"><i class='kt-menu__link-icon flaticon2-trash'></i>Trash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--END DELETE MODAL-->
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
    <script src="{{ asset("assets/admin/js/page-level/fre/manage-fre.js") }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endsection