<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>

       
    <meta charset="UTF-8">

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta content="@yield("seo-description")" name="description"/>
    <meta content="@yield("seo-author")" name="author"/>
    <meta content="@yield("seo-keywords")" name="keywords"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <meta property="og:description" content="@yield("seo-og-description")"/>
    <meta property="og:image" content="{{ asset("assets/admin/media/logos/og-image.jpeg") }}"/>
    <meta property="og:title" content="@yield("seo-og-title")"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield("meta")

        <!-- Load CSS
        =====================================-->
        <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap/bootstrap-modal.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap/bootstrap-spinner.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/font-awesome/font-awesome.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap-select/bootstrap-select.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/owl-carousel/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/owl-carousel/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/slick/slick.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/magnific-popup/magnific-popup.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/jquery-ui/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/chart/chart.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/dropzone/dropzone.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/animate/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/timepicker/bootstrap-timepicker.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/mapbox-gl/mapbox-gl.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/data-tables/jquery-datatables.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/theme.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/css/styles.css')}}">

        <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/favicon.ico') }}"/>

        @yield('page-level-styles')
    </head>

    <body id="topPage" data-spy="scroll" data-target=".navbar" data-offset="100">
        <div id="preloader">
                <div class="loader">
                        <span class="loader-inner-1"></span>
                        <span class="loader-inner-2"></span>
                        <span class="loader-inner-3"></span>
                        <span class="loader-inner-4"></span>
                </div>
        </div>
        
        @include('frontend.layouts._header')

        @yield('main-content')

        @include('frontend.layouts._footer')

         <!-- Back To Top -->
        <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="fa fa-arrow-up"></i></a>
        <!-- End Back To Top -->

        <!-- Contact Modal -->
        <div class="modal fade" id="enquiryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="exampleModalCenterTitle">Get In Touch!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="#" method="POST" id="enquiryForm">
                                @method('POST')

                                <div class="spinner-body d-flex justify-content-center align-items-center">
                                    <div class="spinner-border text-primary d-none" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <input type="hidden" name="model_id" id="model_id">
                                <input type="hidden" name="model" id="model">
                                <div class="prc_wrap-body p-0">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 d-none" id="msgBoxOuter">
                                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" name="first_name txt-field-outline" required minlength="2" data-error="Please enter valid first name"
                                                    class="form-control simple" id="first_name">
                                                <div class="help-block with-errors text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" name="last_name" required minlength="2" data-error="Please enter valid last name"
                                                    class="form-control simple txt-field-outline" id="last_name">
                                                <div class="help-block with-errors text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control simple txt-field-outline" id="email"
                                                required minlength="2" data-error="Please enter valid email">
                                                <div class="help-block with-errors text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="phone_number">Phone Number</label>
                                                <input type="tel" name="phone_number" required pattern="[0-9]{10}" minlength="10" maxlength="10" data-error="Please enter valid phone number"
                                                    class="form-control simple txt-field-outline" id="phone_number">
                                                <div class="help-block with-errors text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" name="city" required minlength="2" maxlength="255" data-error="Please enter valid city"
                                                    class="form-control simple txt-field-outline" id="city">
                                                <div class="help-block with-errors text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <input type="text" name="state" required maxlength="255" data-error="Please enter valid state"
                                                    class="form-control simple txt-field-outline" id="state">
                                                <div class="help-block with-errors text-danger"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control simple txt-field-outline" id="message" name="message"
                                                data-error="Please enter message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-lg-flex justify-content-center">
                                            <button class="btn btn-primary btn-red" type="submit">Approach Us</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Contact Modal -->


        <!-- Load JS
        =====================================-->
        <script src="{{asset('assets/frontend/js/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/bootstrap/bootstrap-bundle.js')}}"></script>
        <script src="{{asset('assets/frontend/js/bootstrap-select/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/slick/slick.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/waypoints/jquery-waypoints.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/magnific-popup/magnific-popup.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/chart/chart.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/dropzone/dropzone.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/timepicker/bootstrap-timepicker.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/hc-sticky/hc-sticky.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/jparallax/tween-max.js')}}"></script>
        <script src="{{asset('assets/frontend/js/mapbox-gl/mapbox-gl.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/data-tables/jquery-datatables.min.js')}}"></script>
        <script src="{{asset('assets/frontend/js/theme.js')}}"></script>
        <script src="{{asset('assets/frontend/js/form-validator.js')}}"></script>
        <script src="{{asset('assets/frontend/js/contact-form.js')}}"></script>
        <script src="{{asset('assets/frontend/js/main.js')}}"></script>
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175459904-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-175459904-1');
        </script>

        @yield('page-level-scripts')
    </body>
</html>