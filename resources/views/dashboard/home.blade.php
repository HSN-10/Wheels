@extends('layouts.dashboard')
@section('title' ,  Lang::get('global.dashboard') . ' | '. Lang::get('global.home'))
@section('content')
<div class="row grouped-multiple-statistics-card">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                            <span class="card-icon primary d-flex justify-content-center mr-3">
                                <i class="feather icon-list p-1 customize-icon font-large-2 p-1"></i>
                            </span>
                            <div class="stats-amount mr-3">
                                <h3 class="heading-text text-bold-600" id="categoriesCount"
                                    data-toggle="tooltip" data-placement="top" data-original-title="32423"></h3>
                                <p class="sub-heading">@lang('global.posts')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                            <span class="card-icon primary d-flex justify-content-center mr-3">
                                <i class="feather icon-bell p-1 customize-icon font-large-2 p-1"></i>
                            </span>
                            <div class="stats-amount mr-3">
                                <h3 class="heading-text text-bold-600" id="questionsCount"
                                    data-toggle="tooltip" data-placement="top" data-original-title=""></h3>
                                <p class="sub-heading">@lang('global.alerts')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                        <div class="d-flex align-items-start">
                            <span class="card-icon primary d-flex justify-content-center mr-3">
                                <i class="feather icon-users p-1 customize-icon font-large-2 p-1"></i>
                            </span>
                            <div class="stats-amount mr-3">
                                <h3 class="heading-text text-bold-600" id="usersCount"
                                    data-toggle="tooltip" data-placement="top" data-original-title=""></h3>
                                <p class="sub-heading">@lang('global.user')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                        <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                            <span class="card-icon primary d-flex justify-content-center mr-3">
                                <i class="feather icon-alert-triangle p-1 customize-icon font-large-2 p-1"></i>
                            </span>
                            <div class="stats-amount mr-3">
                                <h3 class="heading-text text-bold-600" id="reportsCount"
                                    data-toggle="tooltip" data-placement="top" data-original-title="324"></h3>
                                <p class="sub-heading">@lang('global.reports')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <!-- Column Basic Chart Start -->
        <div class="card">
            <div class="card-body">
                <div class="card-title"><h4><i class="fas fa-chart-bar"></i> @lang('global.charPosts')</h4></div>

                <div id="chart"></div>
            </div>
        </div>
        <!-- column basic chart end -->
    </div>
</div>


@endsection

{{-- CSS --}}
@push('VendorCSS')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/apexcharts.css')}}">
@endpush
@push('ThemeCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom.css') }}">
@endpush
@push('PageCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/card-statistics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-tooltip.css') }}">
@endpush

{{-- JS --}}
@push('PageVendorJS')
<script src="{{ asset('app-assets/vendors/js/charts/apexcharts/apexcharts.min.js') }}"></script>
@endpush
@push('PageJS')
<script src="{{ asset('app-assets/vendors/js/extensions/numeral/numeral.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/tooltip/tooltip.js') }}"></script>
    <script>
    </script>
@endpush
