@extends('admin.layouts.template')

@section('title', 'Update Config | Perks Properties')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Update Config
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('config.update', $config->id) }}" method="POST"
                          enctype="multipart/form-data" id="update-config">
                        @csrf
                        @method('PUT')
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Default SEO Author</label>
                                <input type="default_seo_author" name="default_seo_author"
                                       class="form-control @error('default_seo_author') is-invalid @enderror"
                                       placeholder="Enter SEO Author" value="{{ old('default_seo_author', $config->default_seo_author) }}">
                                @error('default_seo_author')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Author name for the website</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>Default SEO Description</label>
                                <input type="default_seo_description" name="default_seo_description"
                                       class="form-control @error('default_seo_description') is-invalid @enderror"
                                       placeholder="Enter SEO Description" value="{{ old('default_seo_description', $config->default_seo_description) }}">
                                @error('default_seo_description')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Short description to make the config SEO friendly</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>Default SEO Keywords</label>
                                <input type="default_seo_keywords" name="default_seo_keywords"
                                       class="form-control @error('default_seo_keywords') is-invalid @enderror"
                                       placeholder="Enter SEO Keywords" value="{{ old('default_seo_keywords', $config->default_seo_keywords) }}">
                                @error('default_seo_keywords')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Write comma separated words to make the config SEO friendly</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>Default SEO OG Title</label>
                                <input type="default_seo_og_title" name="default_seo_og_title"
                                       class="form-control @error('default_seo_og_title') is-invalid @enderror"
                                       placeholder="Enter SEO OG Title" value="{{ old('default_seo_og_title', $config->default_seo_og_title) }}">
                                @error('default_seo_og_title')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Title displayed when you share the config link</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>Default SEO OG Description</label>
                                <input type="default_seo_og_description" name="default_seo_og_description"
                                       class="form-control @error('default_seo_og_description') is-invalid @enderror"
                                       placeholder="Enter SEO OG Description" value="{{ old('default_seo_og_description', $config->default_seo_og_description) }}">
                                @error('default_seo_og_description')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Short description displayed when you share the config link</span>
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
    <!--start::Page Scripts -->
    <script src="{{ asset('assets/admin/js/page-level/config/edit-config.js') }}" type="text/javascript"></script>
    <!--end::Page Scripts -->
@endsection
