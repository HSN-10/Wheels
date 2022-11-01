<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header font-medium-1">
                <i class="fa fa-minus" style="margin-left:5px;"></i>
                <span>@lang('global.dashboard')</span>
            </li>
            <li @if(Request::route()->getName()=='dashboard') class="active" @endif>
                <a href="{{route('dashboard')}}">
                    <i class="feather icon-home"></i><span class="menu-title" data-i18n="@lang('global.home')">@lang('global.home')</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-car"></i>
                    <span class="menu-title" data-i18n="@lang('global.BodyTypes')">@lang('global.BodyTypes')</span>
                </a>
                <ul class="menu-content">
                    <li @if(Request::route()->getName()=='BodyType.create') class="active" @endif>
                        <a class="menu-item" href="" data-i18n="@lang('global.createBodyType')">
                            <i class="fa fa-plus icon-menu"></i> @lang('global.createBodyType')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='category.index' || Request::route()->getName()=='category.edit' || Request::route()->getName()=='category.show' ||
                            Request::route()->getName()=='score.index' || Request::route()->getName()=='score.edit' || Request::route()->getName()=='score.show' ||
                            Request::route()->getName()=='score.trash' )
                        class="active"
                        @endif>
                        <a class="menu-item" href="" data-i18n="@lang('global.BodyTypes')">
                            <i class="fa fa-table icon-menu" style="margin-top: 3.5px;"></i> @lang('global.BodyTypes')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='category.trash') class="active" @endif>
                        <a class="menu-item" href="" data-i18n="@lang('global.trash')">
                            <i class="fa fa-trash icon-menu" style="margin-top: 2px;"></i> @lang('global.trash')
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
