@extends('admin.layouts.template')

@section('title', 'Change Password | Perks Properties')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Change Password
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('users.update-password') }}" method="POST"
                          enctype="multipart/form-data" id="change-password">
                        @csrf
                        @method('put')
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Enter Old Password <span class="text-danger">*</span></label>
                                    <input type="password" name="old_password"
                                           class="form-control @error('old_password') is-invalid @enderror"
                                           placeholder="Enter old password" value="{{ old('old_password') }}">
                                    @error('old_password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Enter New Password <span class="text-danger">*</span></label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password"
                                           placeholder="Enter Password" value="{{ old('password') }}">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Confirm New Password <span class="text-danger">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required
                                           autocomplete="new-password" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                                </div>

                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-label-success btn-bold">
                                    <i class="fa fa-check"></i> Submit
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
    <script src="{{ asset('assets/admin/js/page-level/users/change-password.js') }}" type="text/javascript"></script>
@endsection
