@extends('admin.layouts.template')

@section('title', 'Update Testimonial | Perks Properties')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Update Testimonial
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('testimonials.update', $testimonial->id) }}" method="POST"
                          enctype="multipart/form-data" id="edit-testimonial">
                        @csrf
                        @method('PUT')
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="name" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Enter name" value="{{ old('name', $testimonial->name) }}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="form-group col-md-6">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input type="city" name="city"
                                           class="form-control @error('city') is-invalid @enderror"
                                           placeholder="Enter City"
                                           value="{{ old('city', $testimonial->city) }}">
                                    @error('city')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="kt-tinymce col-md-12">
                                    <label>Testimonial <span class="text-danger">*</span></label>
                                    <textarea id="testimonial-body" name="testimonial"
                                              class="tox-target">{{ old('testimonial', $testimonial->testimonial) }}</textarea>
                                    @error('testimonial')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 mt-4">
                                    <label>Image <span class="text-danger">*</span></label>
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="kt-avatar kt-avatar--outline" id="image">
                                            <div class="kt-avatar__holder"
                                                 style="background-image: url('{{ asset("storage/$testimonial->image") }}');"></div>
                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                                                   data-original-title="Change image">
                                                <i class="fas fa-pen"></i>
                                                <input type="file" name="image" value="">
                                            </label>
                                            @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                            @else
                                                <span class="form-text text-muted">Size of the file should not be more than 1MB (500 x 500)</span>
                                                @enderror
                                        </div>
                                    </div>
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
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <style>
        .kt-avatar .kt-avatar__holder {
            width: 300px;
            height: 300px;
        }
    </style>
@endsection

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('scripts')
    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ asset('assets/admin/js/pages/components/extended/dual-listbox.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/admin/plugins/custom/tinymce/tinymce.bundle.js') }}" type="text/javascript"></script>
    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/admin/js/page-level/testimonials/edit-testimonial.js') }}"
            type="text/javascript"></script>
    <!--end::Page Scripts -->
@endsection
