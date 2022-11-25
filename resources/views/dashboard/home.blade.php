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
                                <h3 class="heading-text text-bold-600" id="postsCount"
                                    data-toggle="tooltip" data-placement="top" data-original-title="{{$postCount}}"></h3>
                                <p class="sub-heading">@lang('global.posts')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                            <span class="card-icon primary d-flex justify-content-center mr-3">
                                <i class="fa fa-car p-1 customize-icon font-large-2 p-1"></i>
                            </span>
                            <div class="stats-amount mr-3">
                                <h3 class="heading-text text-bold-600" id="bodyTypesCount"
                                    data-toggle="tooltip" data-placement="top" data-original-title="{{$bodyTypeCount}}"></h3>
                                <p class="sub-heading">@lang('global.bodyTypes')</p>
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
                                    data-toggle="tooltip" data-placement="top" data-original-title="{{$userCount}}"></h3>
                                <p class="sub-heading">@lang('global.users')</p>
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
                                    data-toggle="tooltip" data-placement="top" data-original-title="{{$reportCount}}"></h3>
                                <p class="sub-heading">@lang('global.reports')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8 col-md-8">
        <!-- Column Basic Chart Start -->
        <div class="card">
            <div class="card-body">
                <div class="card-title"><h4><i class="fas fa-chart-bar"></i> @lang('global.charPosts')</h4></div>

                <div id="chart"></div>
            </div>
        </div>
        <!-- column basic chart end -->
    </div>
            <!-- Zero configuration table -->
            <div class="col-4">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <form>
                                <h4 class="form-section"><i class="fas fa-list"></i> @lang('global.reports')</h4>
                            </form>
                            <table class="table table-striped table-bordered datatables">
                                <thead>
                                    <tr>
                                        <th>@lang('global.post')</th>
                                        <th>@lang('global.numberOfReports')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td><a href="{{route('post.edit',$report->post)}}">{{$report->post->title}}</a></td>
                                            <td>{{$report->total}}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>@lang('global.post')</th>
                                        <th>@lang('global.numberOfReports')</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ Zero configuration table -->
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
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/card-statistics.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
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
        $(document).ready(function() {
            let table = $('.datatables').DataTable({
                    columns: [
                        { "width": "95%" },
                        { "width": "5%" },
                    ],
            });
        });
        let postsCount = numeral({{$postCount}}).format('0a');
        let bodyTypesCount = numeral({{$bodyTypeCount}}).format('0a');
        let usersCount = numeral({{$userCount}}).format('0a');
        let reportsCount = numeral({{$reportCount}}).format('0a');
        document.getElementById('postsCount').innerText = postsCount;
        document.getElementById('bodyTypesCount').innerText = bodyTypesCount;
        document.getElementById('usersCount').innerText = usersCount;
        document.getElementById('reportsCount').innerText = reportsCount;

        let date = [ @foreach($data['date'] as $date) '{{$date}}', @endforeach ];
        let number = [ @foreach($data['number'] as $number) {{$number}}, @endforeach ];
        var options = {
            chart: {
                height: 350,
                type: 'bar',
            },
            series: [{
                name: '@lang("global.post")',
                data: number
            }],
            xaxis: {
                categories: date
            },
            fill:{
                colors:'#00b5b8'
            }
        }
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush
