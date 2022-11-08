@extends('layouts.dashboard')
@section('title' ,  Lang::get('global.dashboard') . ' | '. Lang::get('global.edit') . " " . Lang::get('global.user'))
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">@lang('global.edit') @lang('global.user')</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('global.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('user.index')}}">@lang('global.users')</a></li>
                    <li class="breadcrumb-item active"><span>@lang('global.edit') @lang('global.user')</span></li>
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
                            <form action="{{route('user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                                <h4 class="form-section"><i class="fas fa-list"></i> @lang('global.edit') @lang('global.user')</h4>
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="row">
                                    <fieldset class="form-group col-6 mb-2">
                                        <label for="name">@lang('global.name')</label>
                                        <input type="text" class="form-control @error('name') is-invalid text-danger @enderror" id="name"
                                                placeholder="@lang('global.name')" name="name" value="{{$user->name}}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-6 mb-2">
                                        <label for="email">@lang('global.email')</label>
                                        <input type="text" class="form-control @error('email') is-invalid text-danger @enderror" id="email"
                                                placeholder="@lang('global.email')" name="email" value="{{$user->email}}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-6 mb-2">
                                        <label for="phone">@lang('global.phone')</label>
                                        <input type="text" class="form-control @error('phone') is-invalid text-danger @enderror" id="phone"
                                                placeholder="@lang('global.phone')" name="phone" value="{{$user->phone}}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-6 mb-2 @error('is_admin') has-error @enderror">
                                        <label for="is_admin">@lang('global.role')</label>
                                        <select name="is_admin" class="select2 form-control withoutSearch @error('is_admin') is-invalid text-danger @enderror" id="is_admin">
                                            <option value="1" @if($user->is_admin) selected @endif>@lang('global.admin')</option>
                                            <option value="0" @if(!$user->is_admin) selected @endif>@lang('global.user')</option>
                                        </select>
                                        @error('is_admin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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
