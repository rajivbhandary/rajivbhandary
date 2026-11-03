@extends('admin.layouts.template')

@section('title', 'Update Tag | Perks Properties')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Update Tag
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('tags.update', $tag->id) }}" method="POST"
                          enctype="multipart/form-data" id="update-tag">
                        @csrf
                        @method('PUT')
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="name" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter name" value="{{ old('name', $tag->name) }}">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-label-success btn-bold">
                                    <i class="fas fa-pen"></i> Update
                                </button>
                                <button type="reset" class="btn btn-label-danger btn-bold">
                                    <i class="fa fa-times"></i> Reset
                                </button>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>

@endsection


@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('scripts')
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/admin/js/page-level/tags/edit-tag.js') }}" type="text/javascript"></script>
    <!--end::Page Scripts -->
@endsection
