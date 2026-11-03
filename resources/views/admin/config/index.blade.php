@extends('admin.layouts.template')

@section('title', 'Config | Perks Properties')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">

        @include('admin.layouts.partials._message')

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Manage Config
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('config.edit', $config) }}" class="btn btn-brand btn-elevate">
                                <i class="flaticon-edit"></i>
                                Update Config
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-widget1">
                    <div class="kt-widget1__item">
                        <div class="kt-widget1__info">
                            <h3 class="kt-widget1__title"><i class="flaticon2-next"></i> Default SEO Author:</h3>
                            <span class="kt-widget1__desc">{{ $config->default_seo_author }}</span>
                        </div>
                    </div>
                    <div class="kt-widget1__item">
                        <div class="kt-widget1__info">
                            <h3 class="kt-widget1__title"><i class="flaticon2-next"></i> Default SEO Description:</h3>
                            <span class="kt-widget1__desc">{{ $config->default_seo_description }}</span>
                        </div>
                    </div>
                    <div class="kt-widget1__item">
                        <div class="kt-widget1__info">
                            <h3 class="kt-widget1__title"><i class="flaticon2-next"></i> Default SEO Keywords:</h3>
                            <span class="kt-widget1__desc">{{ $config->default_seo_keywords }}</span>
                        </div>
                    </div>
                    <div class="kt-widget1__item">
                        <div class="kt-widget1__info">
                            <h3 class="kt-widget1__title"><i class="flaticon2-next"></i> Default SEO OG Title:</h3>
                            <span class="kt-widget1__desc">{{ $config->default_seo_og_title }}</span>
                        </div>
                    </div>
                    <div class="kt-widget1__item">
                        <div class="kt-widget1__info">
                            <h3 class="kt-widget1__title"><i class="flaticon2-next"></i> Default SEO OG Description:</h3>
                            <span class="kt-widget1__desc">{{ $config->default_seo_og_description }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
