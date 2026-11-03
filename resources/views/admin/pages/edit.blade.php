@extends('admin.layouts.template')

@section('title', 'Edit Page | Perks Properties')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Update Page
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('pages.update', $page->id) }}" method="POST"
                          enctype="multipart/form-data" id="update-page">
                        @csrf
                        @method('PUT')
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>SEO Description</label>
                                <input type="seo_description" name="seo_description"
                                       class="form-control @error('seo_description') is-invalid @enderror"
                                       placeholder="Enter SEO Description" value="{{ old('seo_description', $page->seo_description) }}">
                                @error('seo_description')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Short description to make the page SEO friendly</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>SEO Keywords</label>
                                <input type="seo_keywords" name="seo_keywords"
                                       class="form-control @error('seo_keywords') is-invalid @enderror"
                                       placeholder="Enter SEO Keywords" value="{{ old('seo_keywords', $page->seo_keywords) }}">
                                @error('seo_keywords')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Write comma separated words to make the page SEO friendly</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>SEO OG Title</label>
                                <input type="seo_og_title" name="seo_og_title"
                                       class="form-control @error('seo_og_title') is-invalid @enderror"
                                       placeholder="Enter SEO OG Title" value="{{ old('seo_og_title', $page->seo_og_title) }}">
                                @error('seo_og_title')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Title displayed when you share the page link</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>SEO OG Description</label>
                                <input type="seo_og_description" name="seo_og_description"
                                       class="form-control @error('seo_og_description') is-invalid @enderror"
                                       placeholder="Enter SEO OG Description" value="{{ old('seo_og_description', $page->seo_og_description) }}">
                                @error('seo_og_description')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Short description displayed when you share the page link</span>
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
    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ asset('assets/admin/plugins/custom/tinymce/tinymce.bundle.js') }}" type="text/javascript"></script>
    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/admin/js/page-level/pages/edit-page.js') }}" type="text/javascript"></script>
    <!--end::Page Scripts -->
@endsection
