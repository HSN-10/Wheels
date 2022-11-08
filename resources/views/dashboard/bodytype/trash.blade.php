@extends('layouts.dashboard')
@section('title' ,  Lang::get('global.dashboard') . ' | '. Lang::get('global.trash'))
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">@lang('global.trash')</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('global.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('bodytype.index')}}">@lang('global.bodyTypes')</a></li>
                    <li class="breadcrumb-item active"><span>@lang('global.trash')</span></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Zero configuration table -->
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <form>
                                <h4 class="form-section"><i class="fas fa-list"></i> @lang('global.trash')</h4>
                            </form>
                            <table class="table table-striped table-bordered datatables">
                                <thead>
                                <tr>
                                    <th>@lang('global.id')</th>
                                    <th>@lang('global.image')</th>
                                    <th>@lang('global.name')</th>
                                    <th>@lang('global.options')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bodyTypes as $bodyType)
                                    <tr>
                                        <td>{{$bodyType->id}}</td>
                                        <td><img class="rounded img-thumbnail" src="{{ asset('storage/'.$bodyType->icon) }}"></td>
                                        <td>{{$bodyType->name}}</td>
                                        <td>
                                            <div class="d-none d-md-block">
                                                <div class="btn-group">
                                                    <a href="{{route('bodytype.undo', $bodyType->id)}}" class="btn btn-group btn-info square">
                                                        <i class="fas fa-undo mr-1"></i> @lang('global.undo')
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-sm-block d-xs-block d-lg-none d-md-none">
                                                <div class="btn-group mr-1 mb-1">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                                                    <div class="dropdown-menu" style="right: -150% !important;">
                                                        <a class="dropdown-item"
                                                            href="{{route('bodytype.undo', $bodyType->id)}}">
                                                            <i class="fas fa-undo mr-1"></i> @lang('global.undo')
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>@lang('global.id')</th>
                                    <th>@lang('global.image')</th>
                                    <th>@lang('global.name')</th>
                                    <th>@lang('global.options')</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Zero configuration table -->
</div>
@endsection

{{-- CSS --}}
@push('VendorCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endpush
@push('ThemeCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom.css') }}">
@endpush
@push('PageCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
@endpush

{{-- JS --}}
@push('PageVendorJS')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endpush

@push('PageJS')
    <script src="{{ asset('app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
    <script>
        $('.datatables').DataTable({
            "columns": [
                { "width": "3%" },
                { "width": "20%" },
                { "width": "70%" },
                { "width": "2%" }
            ]
        });
        
    </script>
@endpush
