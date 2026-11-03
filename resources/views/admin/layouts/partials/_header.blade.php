<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed">

    <!-- begin:: Aside -->
    <div class="kt-header__brand kt-grid__item  " id="kt_header_brand">
        <div class="kt-header__brand-logo">
            <a href="{{ route('admin.dashboard') }}">
                <img alt="Logo" src="{{ asset('assets/admin/media/logos/logo-md.png') }}"/>
            </a>
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Title -->
    <h3 class="kt-header__title kt-grid__item">
        @yield('admin-nav-head','Perks Properties -Admin Panel')
    </h3>

    <!-- end:: Title -->

    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i>
    </button>

    <!-- end: Header Menu -->


    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">
        @auth
            <!--begin: User bar -->
            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                    <span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
                    <span class="kt-hidden kt-header__topbar-username">Nick</span>
                    <img class="" alt="Pic" src="{{ asset("storage/". Auth::user()->image) }}"/>
{{--                    <span class="kt-header__topbar-icon kt-hidden-"><i class="flaticon2-user-outline-symbol"></i></span>--}}
                </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                    <!--begin: Head -->
                    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                         style="background: #C1272D;">
                        <div class="kt-user-card__avatar">
                            <img class="rounded-circle rounded" alt="Pic" src="{{ asset("storage/". Auth::user()->image) }}"/>

                            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
{{--                            <span--}}
{{--                                class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-brand">{{ Auth::user()->name_initials }}</span>--}}
                        </div>
                        <div class="kt-user-card__name">
                            {{ Auth::user()->name }}
                        </div>
                    </div>

                    <!--end: Head -->

                    <!--begin: Navigation -->
                    <div class="kt-notification">
                        <a href="{{ route('users.edit', auth()->user()) }}" class="kt-notification__item">
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Edit Profile Information
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('users.change-password') }}" class="kt-notification__item">
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Change Password
                                </div>
                            </div>
                        </a>

                        @can('delete', auth()->user())
                            <a href="#" data-toggle="modal" data-target="#deactivateAccountModal"
                               class="kt-notification__item">
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title kt-font-bold">
                                        Deactivate Account
                                    </div>
                                </div>
                            </a>
                        @endcan

                    </div>
                    <div class="kt-notification">
                        <div class="kt-notification__custom kt-space-between justify-content-end">
                            <a href="{{ route('logout') }}" target="_blank"
                               class="btn btn-label btn-label-brand btn-sm btn-bold "
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign
                                Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <!--end: Navigation -->
                </div>
            </div>
            <!--end: User bar -->
        @endauth
    </div>

    <!-- end:: Header Topbar -->
</div>
