@extends('layouts.dashboard')
@section('title' ,  Lang::get('global.dashboard') . ' | '. Lang::get('global.create') .' '. Lang::get('global.bodyType'))
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">@lang('global.create') @lang('global.bodyType')</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('global.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('bodytype.index')}}">@lang('global.bodyTypes')</a></li>
                    <li class="breadcrumb-item active"><span>@lang('global.create') @lang('global.bodyType')</span></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Basic Elements start -->
    <section class="basic-elements">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{route('bodytype.store')}}" method="POST" enctype="multipart/form-data">
                                <h4 class="form-section"><i class="fas fa-list"></i> @lang('global.create') @lang('global.bodyType')</h4>
                                @csrf
                                <div class="row">
                                    <fieldset class="form-group col-6 mb-2">
                                        <label for="name">@lang('global.name')</label>
                                        <input type="text" class="form-control @error('name') is-invalid text-danger @enderror" id="name"
                                                placeholder="@lang('global.name')" name="name" value="{{old('name')}}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-6 mb-2">
                                        <label for="image">@lang('global.image')</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input  @error('image') is-invalid text-danger @enderror" id="image" name="image"
                                                    accept="image/x-png,image/gif,image/jpeg,image/svg,image/webp" value="{{old('image')}}">
                                            <label class="custom-file-label" for="image">@lang('global.chooseFile')</label>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="form-actions clearfix">
                                    <div class="buttons-group float-right">
                                        <button type="submit" class="btn btn-success">
                                            @lang('global.save')
                                            <i class="fas fa-check"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Inputs end -->
</div>


@endsection

{{-- CSS --}}
@push('VendorCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
@endpush
@push('ThemeCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom.css') }}">
@endpush
@push('PageCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <style>
        .custom-file-label::after{
            content: '@lang('global.browse')';
        }
    </style>
@endpush

{{-- JS --}}
@push('PageJS')
<script src="{{ asset('app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
@endpush
