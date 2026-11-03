@extends('admin.layouts.template')

@section('title', 'Update Blog | Perks Properties')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Update Blog
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('blogs.update', $blog) }}" method="POST"
                          enctype="multipart/form-data" id="update-blog">
                        @csrf
                        @method('PUT')
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="title" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       placeholder="Enter title" value="{{ old('title', $blog->title) }}">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Excerpt <span class="text-danger">*</span></label>
                                <input type="excerpt" name="excerpt"
                                       class="form-control @error('excerpt') is-invalid @enderror"
                                       placeholder="Enter excerpt" value="{{ old('excerpt', $blog->excerpt) }}">
                                @error('excerpt')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                <span class="form-text text-muted">Short description for blog which will be displayed outside</span>
                                @enderror
                            </div>


                            <div class="kt-tinymce">
                                <label>Body <span class="text-danger">*</span></label>
                                <textarea id="blog-body" name="body" class="tox-target">{{ old('body', $blog->body) }}</textarea>
                                @error('body')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="row pt-5">
                                <div class="col-md-6">
                                    <label>Tags</label>
                                    <div class="kt-portlet__body">
                                        <select id="tag-select" class="kt-dual-listbox " name="tag_id[]"
                                                multiple="true">
                                            @foreach($tags as $tag)
                                                <option
                                                    value="{{ $tag->id }}" {{ (in_array($tag->id, old('tag_id', $blog->tags->pluck('id')->toArray())) ? 'selected' : ' ') }}>{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Image <span class="text-danger">*</span></label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="kt-avatar kt-avatar--outline" id="image">
                                            <div class="kt-avatar__holder"
                                                 style="background-image: url('{{ asset("storage/$blog->image") }}');"></div>
                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                                                   data-original-title="Change image">
                                                <i class="fas fa-pen"></i>
                                                <input type="file" name="image" value="">
                                            </label>
                                            @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                            @else
                                                <span class="form-text text-muted">Size of the file should not be more than 1MB (500 x 300)</span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Publish At:</label>
                                <div class="col-md-6 pl-0">
                                    <div class="input-group date">
                                        <input type="text" {{ $blog->isPublished() ? 'readonly' : '' }} value="{{ old('published_at', $blog->published_at) }}" name="published_at"
                                               class="form-control"
                                               placeholder="Select date &amp; time" id="published_at">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i
                                                    class="la la-calendar-check-o glyphicon-th"></i></span>
                                        </div>
                                    </div>
                                </div>
                                @error('published_at')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>SEO Description</label>
                                <input type="seo_description" name="seo_description"
                                       class="form-control @error('seo_description') is-invalid @enderror"
                                       placeholder="Enter SEO Description" value="{{ old('seo_description', $blog->seo_description) }}">
                                @error('seo_description')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Short description to make the blog SEO friendly</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>SEO Keywords</label>
                                <input type="seo_keywords" name="seo_keywords"
                                       class="form-control @error('seo_keywords') is-invalid @enderror"
                                       placeholder="Enter SEO Keywords" value="{{ old('seo_keywords', $blog->seo_keywords) }}">
                                @error('seo_keywords')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Write comma separated words to make the blog SEO friendly</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>SEO OG Title</label>
                                <input type="seo_og_title" name="seo_og_title"
                                       class="form-control @error('seo_og_title') is-invalid @enderror"
                                       placeholder="Enter SEO OG Title" value="{{ old('seo_og_title', $blog->seo_og_title) }}">
                                @error('seo_og_title')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Title displayed when you share the blog link</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label>SEO OG Description</label>
                                <input type="seo_og_description" name="seo_og_description"
                                       class="form-control @error('seo_og_description') is-invalid @enderror"
                                       placeholder="Enter SEO OG Description" value="{{ old('seo_og_description', $blog->seo_og_description) }}">
                                @error('seo_og_description')
                                <p class="text-danger">{{ $message }}</p>
                                @else
                                    <span class="form-text text-muted">Short description displayed when you share the blog link</span>
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

@section('styles')
    <style>
        .kt-avatar .kt-avatar__holder {
            width: 500px;
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
    <script src="{{ asset('assets/admin/js/page-level/blogs/edit-blog.js') }}" type="text/javascript"></script>
    <!--end::Page Scripts -->
@endsection
