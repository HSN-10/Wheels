@extends('layouts.dashboard')
@section('title' ,  Lang::get('global.dashboard') . ' | '. Lang::get('global.edit') . " " . Lang::get('global.post'))
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">@lang('global.edit') @lang('global.post')</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('global.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('post.index')}}">@lang('global.posts')</a></li>
                    <li class="breadcrumb-item active"><span>@lang('global.edit') @lang('global.post')</span></li>
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
                            <form action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                                <h4 class="form-section"><i class="fas fa-list"></i> @lang('global.edit') @lang('global.post')</h4>
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="row">
                                    <fieldset class="form-group col-4 mb-2">
                                        <label for="title">@lang('global.title')</label>
                                        <input type="text" class="form-control @error('title') is-invalid text-danger @enderror" id="title"
                                                placeholder="@lang('global.title')" name="title" value="{{$post->title}}">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-4 mb-2">
                                        <label for="description">@lang('global.description')</label>
                                        <input type="text" class="form-control @error('description') is-invalid text-danger @enderror" id="description"
                                                placeholder="@lang('global.description')" name="description" value="{{$post->description}}">
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-4 mb-2">
                                        <label for="price">@lang('global.price')</label>
                                        <input type="number" class="form-control @error('price') is-invalid text-danger @enderror" id="price"
                                                placeholder="@lang('global.price')" name="price" value="{{$post->price}}">
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-4 mb-2 @error('is_ask_price') has-error @enderror">
                                        <label for="is_ask_price">@lang('global.is_ask_price')</label>
                                        <select name="is_ask_price" class="select2 form-control withoutSearch @error('is_ask_price') is-invalid text-danger @enderror" id="is_ask_price">
                                            <option value="1" @if($post->is_ask_price) selected @endif>@lang('global.negotiable')</option>
                                            <option value="0" @if(!$post->is_ask_price) selected @endif>@lang('global.non-negotiable')</option>
                                        </select>
                                        @error('is_ask_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-4 mb-2 @error('type_post') has-error @enderror">
                                        <label for="type_post">@lang('global.typePost')</label>
                                        <select name="type_post" class="select2 form-control withoutSearch @error('type_post') is-invalid text-danger @enderror" id="type_post">
                                            <option value="1" @if($post->type_post==1) selected @endif>@lang('global.sale')</option>
                                            <option value="0" @if($post->type_post==0) selected @endif>@lang('global.request')</option>
                                        </select>
                                        @error('type_post')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-4 mb-2 @error('user_id') has-error @enderror">
                                        <label for="user_id">@lang('global.user')</label>
                                        <select name="user_id" class="select2 form-control withoutSearch @error('user_id') is-invalid text-danger @enderror" id="user_id">
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}" @if($post->user_id==$user->id) selected @endif>{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </fieldset>
                                </div>

                                <h4 class="form-section"><i class="fas fa-list"></i> @lang('global.edit') @lang('global.car')</h4>
                                <div class="row">
                                    <fieldset class="form-group col-4 mb-2">
                                        <label for="maker">@lang('global.maker')</label>
                                        <input type="text" class="form-control @error('maker') is-invalid text-danger @enderror" id="maker"
                                                placeholder="@lang('global.maker')" name="maker" value="{{$post->maker}}">
                                        @error('maker')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-4 mb-2">
                                        <label for="model">@lang('global.model')</label>
                                        <input type="text" class="form-control @error('model') is-invalid text-danger @enderror" id="model"
                                                placeholder="@lang('global.model')" name="model" value="{{$post->model}}">
                                        @error('model')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-4 mb-2">
                                        <label for="colour">@lang('global.colour')</label>
                                        <input type="text" class="form-control @error('colour') is-invalid text-danger @enderror" id="colour"
                                                placeholder="@lang('global.colour')" name="colour" value="{{$post->colour}}">
                                        @error('colour')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-3 mb-2">
                                        <label for="years">@lang('global.years')</label>
                                        <input type="number" class="form-control @error('years') is-invalid text-danger @enderror" id="years"
                                                placeholder="@lang('global.years')" name="years" value="{{$post->years}}">
                                        @error('years')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-3 mb-2 @error('body_type_id') has-error @enderror">
                                        <label for="body_type_id">@lang('global.bodyType')</label>
                                        <select name="body_type_id" class="select2 form-control withoutSearch @error('body_type_id') is-invalid text-danger @enderror" id="body_type_id">
                                            @foreach ($bodyTypes as $bodyType)
                                                <option value="{{$bodyType->id}}" @if($post->body_type_id==$bodyType->id) selected @endif>{{$bodyType->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('body_type_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-3 mb-2 @error('transmission_type') has-error @enderror">
                                        <label for="transmission_type">@lang('global.transmissionType')</label>
                                        <select name="transmission_type" class="select2 form-control withoutSearch @error('transmission_type') is-invalid text-danger @enderror" id="transmission_type">
                                            <option value="1" @if($post->transmission_type==1) selected @endif>@lang('global.automatic')</option>
                                            <option value="0" @if($post->transmission_type==0) selected @endif>@lang('global.manual')</option>
                                        </select>
                                        @error('transmission_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-3 mb-2">
                                        <label for="kilometrage">@lang('global.kilometrage')</label>
                                        <input type="number" class="form-control @error('kilometrage') is-invalid text-danger @enderror" id="kilometrage"
                                                placeholder="@lang('global.kilometrage')" name="kilometrage" value="{{$post->kilometrage}}">
                                        @error('kilometrage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-2 mb-2 @error('gas_type') has-error @enderror">
                                        <label for="gas_type">@lang('global.gasType')</label>
                                        <select name="gas_type" class="select2 form-control withoutSearch @error('gas_type') is-invalid text-danger @enderror" id="gas_type">
                                            <option value="0" @if($post->gas_type==0) selected @endif>@lang('global.diesel')</option>
                                            <option value="1" @if($post->gas_type==1) selected @endif>@lang('global.jayyid')</option>
                                            <option value="2" @if($post->gas_type==2) selected @endif>@lang('global.mumtaz')</option>
                                            <option value="3" @if($post->gas_type==3) selected @endif>@lang('global.super')</option>
                                        </select>
                                        @error('gas_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-2 mb-2">
                                        <label for="doors">@lang('global.doors')</label>
                                        <input type="number" class="form-control @error('doors') is-invalid text-danger @enderror" id="doors"
                                                placeholder="@lang('global.doors')" name="doors" value="{{$post->doors}}">
                                        @error('doors')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-2 mb-2">
                                        <label for="engine_cylinders">@lang('global.engineCylinders')</label>
                                        <input type="number" class="form-control @error('engineCylinders') is-invalid text-danger @enderror" id="engine_cylinders"
                                                placeholder="@lang('global.engine_cylinders')" name="engine_cylinders" value="{{$post->engine_cylinders}}">
                                        @error('engine_cylinders')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-2 mb-2 @error('condition') has-error @enderror">
                                        <label for="condition">@lang('global.condition')</label>
                                        <select name="condition" class="select2 form-control withoutSearch @error('condition') is-invalid text-danger @enderror" id="condition">
                                            <option value="0" @if($post->condition==0) selected @endif>@lang('global.new')</option>
                                            <option value="1" @if($post->condition==1) selected @endif>@lang('global.used')</option>
                                            <option value="2" @if($post->condition==2) selected @endif>@lang('global.scrap')</option>
                                        </select>
                                        @error('condition')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-2 mb-2">
                                        <label for="number_of_owners">@lang('global.numberOfOwner')</label>
                                        <input type="number" class="form-control @error('number_of_owners') is-invalid text-danger @enderror" id="number_of_owners"
                                                placeholder="@lang('global.numberOfOwner')" name="number_of_owners" value="{{$post->number_of_owners}}">
                                        @error('number_of_owners')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group col-2 mb-2">
                                        <label for="number_of_accidents">@lang('global.numberOfaccidents')</label>
                                        <input type="number" class="form-control @error('number_of_accidents') is-invalid text-danger @enderror" id="number_of_accidents"
                                                placeholder="@lang('global.numberOfaccidents')" name="number_of_accidents" value="{{$post->number_of_accidents}}">
                                        @error('number_of_accidents')
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
