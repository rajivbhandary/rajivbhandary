<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
             data-ktmenu-dropdown-timeout="500">
            @auth
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item {{ Request::route()->getName() == "admin.dashboard" ? 'kt-menu__item--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('admin.dashboard') }}" class="kt-menu__link ">
                            <i class="kt-menu__link-icon flaticon2-shelter"></i><span class="kt-menu__link-text">Dashboard</span>
                        </a>
                    </li>

                    @can('viewAny', \App\User::class)
                        <li class="kt-menu__item {{ Str::contains(Request::route()->getName(), "users") ? 'kt-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('users.index') }}" class="kt-menu__link "><i
                                    class="kt-menu__link-icon flaticon2-user-outline-symbol"></i><span
                                    class="kt-menu__link-text">Users</span>
                            </a>
                        </li>
                    @endcan

                    <li class="kt-menu__item  {{ Str::contains(Request::route()->getName(), "properties") ? 'kt-menu__item--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('properties.index')}}" class="kt-menu__link ">
                            <i class="kt-menu__link-icon flaticon-buildings"></i><span
                                class="kt-menu__link-text">Properties</span>
                        </a>
                    </li>

                    <li class="kt-menu__item  {{ Str::contains(Request::route()->getName(), "blogs") ? 'kt-menu__item--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('blogs.index')}}" class="kt-menu__link "><i
                                class="kt-menu__link-icon fas fa-blog"></i><span class="kt-menu__link-text">Blogs</span>
                        </a>
                    </li>

                    @can('viewAny', \App\Tag::class)
                        <li class="kt-menu__item  {{ Str::contains(Request::route()->getName(), "tags") ? 'kt-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('tags.index')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon fa fa-hashtag"></i><span
                                    class="kt-menu__link-text">Tags</span>
                            </a>
                        </li>
                    @endcan

                    @can('viewAny', \App\FRE::class)
                        <li class="kt-menu__item  {{ Str::contains(Request::route()->getName(), "fre") ? 'kt-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('fre.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon fa fa-building"></i><span
                                    class="kt-menu__link-text">FRE</span>
                            </a>
                        </li>
                    @endcan

                    @can('viewAny', \App\Testimonial::class)
                        <li class="kt-menu__item  {{ Str::contains(Request::route()->getName(), "testimonials") ? 'kt-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('testimonials.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon flaticon2-chat-1"></i><span
                                    class="kt-menu__link-text">Testimonials</span>
                            </a>
                        </li>
                    @endcan

                    @can('viewAny', \App\Enquiry::class)
                        <li class="kt-menu__item  {{ Str::contains(Request::route()->getName(), "enquires") ? 'kt-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('enquiries.index') }}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon fa fa-question fa-2x"></i><span
                                    class="kt-menu__link-text">Enquiries</span>
                            </a>
                        </li>
                    @endcan

                    @can('viewAny', \App\Visit::class)
                        <li class="kt-menu__item  {{ Str::contains(Request::route()->getName(), "visits") ? 'kt-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{route('visits.index')}}" class="kt-menu__link "><i
                                    class="kt-menu__link-icon flaticon2-position"></i><span class="kt-menu__link-text">Visits</span>
                            </a>
                        </li>
                    @endcan

                    @can('viewAny', \App\Page::class)
                        <li class="kt-menu__item  {{ Str::contains(Request::route()->getName(), "pages") ? 'kt-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('pages.index') }}" class="kt-menu__link "><i
                                    class="kt-menu__link-icon fa fa-cogs"></i><span
                                    class="kt-menu__link-text">Pages</span>
                            </a>
                        </li>
                    @endcan

                    @can('viewAny', \App\Config::class)
                        <li class="kt-menu__item  {{ Str::contains(Request::route()->getName(), "config") ? 'kt-menu__item--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('config.index') }}" class="kt-menu__link "><i
                                    class="kt-menu__link-icon flaticon2-gear"></i><span class="kt-menu__link-text">Config</span>
                            </a>
                        </li>
                    @endcan

                </ul>
            @endauth
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>
