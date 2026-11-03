@extends('admin.layouts.template')

@section('title', 'Update Profile | Perks Properties')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Update Profile
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('users.update', auth()->user()) }}" method="POST"
                          enctype="multipart/form-data" id="edit-user">
                        @csrf
                        @method('PUT')
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Image <span class="text-danger">*</span></label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="kt-avatar kt-avatar--outline" id="image">
                                            <div class="kt-avatar__holder"
                                                 style="background-image: url('{{ asset("storage/$user->image") }}')"></div>
                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                                                   data-original-title="Change image">
                                                <i class="fas fa-pen"></i>
                                                <input type="file" name="image" value="">
                                            </label>
                                            @error('image')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                            @else
                                                <span class="form-text text-muted">Size of the file should not be more than 1MB (350 x 350)</span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="name" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Enter name" value="{{ old('name', $user->name) }}">
                                    @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Enter email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Phone_number <span class="text-danger">*</span></label>
                                    <input type="phone_number" name="phone_number"
                                           class="form-control @error('phone_number') is-invalid @enderror"
                                           placeholder="Enter phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                                    @error('phone_number')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Facebook id</label>
                                    <input type="text" name="facebook_id"
                                           class="form-control @error('facebook_id') is-invalid @enderror"
                                           placeholder="Enter facebook id" value="{{ old('facebook_id', $user->facebook_id) }}">
                                    @error('facebook_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Instagram id</label>
                                    <input type="text" name="instagram_id"
                                           class="form-control @error('instagram_id') is-invalid @enderror"
                                           placeholder="Enter instagram id" value="{{ old('instagram_id', $user->instagram_id) }}">
                                    @error('instagram_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Twitter id</label>
                                    <input type="text" name="twitter_id"
                                           class="form-control @error('twitter_id') is-invalid @enderror"
                                           placeholder="Enter twitter id" value="{{ old('twitter_id', $user->twitter_id) }}">
                                    @error('twitter_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Behance id</label>
                                    <input type="text" name="behance_id"
                                           class="form-control @error('behance_id') is-invalid @enderror"
                                           placeholder="Enter behance id" value="{{ old('behance_id', $user->behance_id) }}">
                                    @error('behance_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Youtube id</label>
                                    <input type="text" name="youtube_id"
                                           class="form-control @error('youtube_id') is-invalid @enderror"
                                           placeholder="Enter youtube id" value="{{ old('youtube_id', $user->youtube_id) }}">
                                    @error('youtube_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Linked in id</label>
                                    <input type="text" name="linked_in_id"
                                           class="form-control @error('linked_in_id') is-invalid @enderror"
                                           placeholder="Enter linked in id" value="{{ old('linked_in_id', $user->linked_in_id) }}">
                                    @error('linked_in_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>About </label>
                                    <textarea type="about" name="about"
                                              class="form-control @error('about') is-invalid @enderror"
                                              placeholder="Tell us something about you..."
                                              rows="3">{{ old('about', $user->about) }}</textarea>
                                    @error('about')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
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
            width: 250px;
            height: 250px;
        }

        .kt-avatar .kt-avatar__upload {
            right: 45px;
        }
    </style>
@endsection

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/page-level/users/edit-user.js') }}" type="text/javascript"></script>
@endsection
